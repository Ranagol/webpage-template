<?php

namespace Domain\Report\Service;

use App\Exceptions\BaseException;
use App\Models\User;
use Domain\Report\CsvReader\CsvReader;
use Domain\Report\ReportDomain\CsvFile;

class UploadService
{
    /**
     *  this is = to $_FILES now, we can treat $uploadData as the $_FILES.
     *
     * @var array<string, mixed>
     */
    private array $uploadData;

    /**
     * All the allowed upload formats are stored here.
     * The 'application/vnd.ms-excel' or 'text/csv' means .csv file.
     *
     * @var array<int, string>
     */
    private array $allowedFileFormats = [
        'text/plain',
        'application/vnd.ms-excel',
        'text/csv',
    ];

    /**
     * The name of the file is stored here.
     */
    private string $fileName;

    /**
     * The type of the file is stored here.
     */
    private string $fileType;

    /**
     * The size of the uploaded file.
     */
    private float $fileSize;

    /**
     * The maximum allowed size for the uploaded file.
     */
    private float $maxFileSize = 5 * 1024 * 1024;

    /** @param array<string, mixed> $uploadData */
    public function __construct(array $uploadData)
    {
        $this->uploadData = $uploadData;
    }

    /**
     * This is the central, main function that calls all other functions
     * regarding the file uploading. Now, the process is same for images and csv files - almost. The
     * only difference is, that if we are uploading a csv file, then we need to process it, once the
     * upload is successfull.
     */
    public function storeFile(): CsvFile
    {
        $this->setFileSizeNameType();
        $this->validateFileType();
        $this->validateFileSize();
        $this->putFileIntoStorage();
        $csvFile = $this->activateCsvProcessing();

        return $csvFile;
    }

    /**
     * We set the uploaded file name, type, size - so these parameters can be validated.
     * Name, type and size are set in the class variables on the top.
     *
     * @throws BaseException
     */
    private function setFileSizeNameType(): void
    {
        $uploadData = $this->getUploadData();

        if (isset($uploadData['file']) && is_array($uploadData['file']) && 0 == $uploadData['file']['error']) {
            $originalName = (string) ($uploadData['file']['name'] ?? 'upload.csv');
            $this->setFileName($this->createSafeFileName($originalName));
            $this->setFileType((string) ($uploadData['file']['type'] ?? ''));
            $this->setFileSize((float) ($uploadData['file']['size'] ?? 0));
        } else {
            throw new BaseException('Error with uploading.');
        }
    }

    /**
     * Checks if the uploaded file type (example: csv) is in the $allowedFileFormats[].
     *
     * @throws BaseException if the file format is not allowed
     */
    private function validateFileType(): void
    {
        $uploadedFile = $this->getUploadedFile();
        $tmpName = (string) ($uploadedFile['tmp_name'] ?? '');
        $originalName = (string) ($uploadedFile['name'] ?? '');
        $extension = strtolower((string) pathinfo($originalName, PATHINFO_EXTENSION));

        if ('csv' !== $extension) {
            throw new BaseException('Error: Please upload a CSV file.');
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        if (false === $finfo) {
            throw new BaseException('Error: Unable to validate file type.');
        }

        $detectedType = finfo_file($finfo, $tmpName);
        finfo_close($finfo);

        if (!is_string($detectedType) || !in_array($detectedType, $this->getAllowedFileFormats(), true)) {
            throw new BaseException('Error: Please select a valid file format.');
        }

        $this->setFileType($detectedType);
    }

    /**
     * Validates the uploaded file size. It has to be smaller than 5MB.
     *
     * @throws BaseException
     */
    private function validateFileSize(): void
    {
        if ($this->getFileSize() > $this->getMaxFileSize()) {
            throw new BaseException('Error: File size is larger than the allowed limit.');
        }
    }

    /**
     * We need to get the user here, because we will use the
     * users email address to create the user's individual directory
     * inside the storage folder. Every user will upload his files into
     * his own directory.
     * What we do here: if the user does not have alredy his directory, then
     * we make him one, and then we move the uploaded file from the temporary
     * $_FILES place to the user's own directory.
     */
    private function putFileIntoStorage(): void
    {
        // get user email - this will be the name of his private storage
        $email = $this->getUserEmail();
        $uploadedFile = $this->getUploadedFile();
        $tmpName = (string) ($uploadedFile['tmp_name'] ?? '');

        if (!is_uploaded_file($tmpName)) {
            throw new BaseException('Invalid upload source.');
        }

        $baseUploadPath = realpath(__DIR__ . '/../../../storage/upload');
        if (false === $baseUploadPath) {
            throw new BaseException('Upload directory is not available.');
        }

        $userUploadPath = $baseUploadPath . '/' . $email;

        // create directory for the upload if there is none yet
        clearstatcache(); // deleting cached stuff
        if (!file_exists($userUploadPath)) {
            $boolean = mkdir($userUploadPath, 0755, true);
            if (!$boolean) {
                throw new BaseException('We could not make a new directory for the uploaded file.');
            }
        }

        $destinationPath = $userUploadPath . '/' . $this->getFileName();

        // place the uploaded file into the new dir
        $stored = move_uploaded_file($tmpName, $destinationPath);
        if (false === $stored) {
            throw new BaseException('Failed to store uploaded file.');
        }
    }

    /**
     * When a .csv file is uploaded, then we need not just to store this file, but to process it too.
     */
    public function activateCsvProcessing(): CsvFile
    {
        // finds and reads the uploaded .csv file
        if ('application/vnd.ms-excel' === $this->getFileType() || 'text/csv' === $this->getFileType()) {
            $csvReader = new CsvReader($this->getUserEmail(), $this->getFileName());
            $csvFile = $csvReader->getCsvFile();

            return $csvFile;
        }
        throw new BaseException('Error: Uploaded file is not a CSV file.');
    }

    private function getUserEmail(): string
    {
        $user = User::getCurrentUser();
        if (!$user instanceof User) {
            throw new BaseException('There is a problem with the user authorization.');
        }

        if (!isset($user->email) || !is_string($user->email)) {
            throw new BaseException('User email is not available.');
        }

        $email = $user->email;

        return $email;
    }

    /**
     * @return array<string, mixed>
     */
    private function getUploadedFile(): array
    {
        $uploadData = $this->getUploadData();
        $file = $uploadData['file'] ?? null;
        if (!is_array($file)) {
            throw new BaseException('No file payload found.');
        }

        return $file;
    }

    private function createSafeFileName(string $originalName): string
    {
        $extension = strtolower((string) pathinfo($originalName, PATHINFO_EXTENSION));
        if ('' === $extension) {
            $extension = 'csv';
        }

        return sprintf('%s_%s.%s', date('YmdHis'), bin2hex(random_bytes(8)), $extension);
    }

    /**
     * Get the value of fileName.
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * Set the value of fileName.
     */
    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get the value of fileType.
     */
    public function getFileType(): string
    {
        return $this->fileType;
    }

    /**
     * Set the value of fileType.
     */
    public function setFileType(string $fileType): self
    {
        $this->fileType = $fileType;

        return $this;
    }

    /**
     * Get the value of fileSize.
     */
    public function getFileSize(): float
    {
        return $this->fileSize;
    }

    /**
     * Set the value of fileSize.
     */
    public function setFileSize(float $fileSize): self
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    /**
     * Get this is = to $_FILES now, we can treat $uploadData as the $_FILES.
     *
     * @return array<string, mixed>
     */
    public function getUploadData(): array
    {
        return $this->uploadData;
    }

    /**
     * Get the value of allowedFileFormats.
     *
     * @return array<int, string>
     */
    public function getAllowedFileFormats(): array
    {
        return $this->allowedFileFormats;
    }

    /**
     * Get the maximum allowed size for the uploaded file.
     */
    public function getMaxFileSize(): float
    {
        return $this->maxFileSize;
    }
}
