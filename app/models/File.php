<?php

namespace App\Models;

use App\models\User;
use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * The File model handles the file uploading.
 */
class File extends Model
{
    /**
     *  this is = to $_FILES now, we can treat $uploadData as the $_FILES
     *
     * @var array
     */
    private $uploadData;

    /**
     * All the allowed upload formats are stored here.
     *
     * @var array
     */
    private $allowedFileFormats = [
        'image/jpg',
        'image/jpeg',
        'image/gif',
        'image/png',
    ];

    /**
     * The name of the file is stored here.
     *
     * @var string
     */
    private $fileName;

    /**
     * The type of the file is stored here.
     *
     * @var string
     */
    private $fileType;

    /**
     * The size of the uploaded file.
     *
     * @var float
     */
    private $fileSize;

    /**
     * The maximum allowed size for the uploaded file.
     *
     * @var float
     */
    private $maxFileSize = 5 * 1024 * 1024;

    public function __construct(array $uploadData)
    {
        $this->uploadData = $uploadData;
    }

    /**
     * This is the central, main function that calls all other functions
     * regarding the file uploading.
     *
     * @return void
     */
    public function storeFile(): void
    {
        $this->setFileSizeNameType();
        $this->validateFileType();
        $this->validateFileSize();
        $this->putFileIntoStorage();
    }

    /**
     * We need to get the user here, because we will use the
     * users email address to create the user's individual directory
     * inside the storage folder. Every user will upload his files into
     * his own directory.
     * What we do here: if the user does not have alredy his directory, then
     * we make him one, and then we move the uploaded file from the temporary
     * $_FILES place to the user's own directory.
     *
     * @return void
     */
    private function putFileIntoStorage(): void
    {
        //get user
        $user = User::getCurrentUser();
        if (!($user instanceof User)) {
            throw new Exception('User is not logged in.');
        }

        //create directory for the upload
        $email = $user->email;
        if (!file_exists(__DIR__ . '/../../storage/upload/' . $email)) {
            $boolean = mkdir(__DIR__ . '/../../storage/upload/' . $email);
            if (!$boolean) {
                throw new Exception('We could not make a new directory for the uploaded file.');
            }
        }

        //place the uploaded file into the new dir
        try {
            $report = move_uploaded_file(
                $_FILES["photo"]["tmp_name"],
                __DIR__ . '/../../storage/upload/' . $email . '/' . $this->getFileName()
            );
        } catch (Exception $error) {
            echo $error->getErrorMessage();
        }
    }

    /**
     * Validates the uploaded file size. It has to be smaller than 5MB.
     *
     * @throws Exception
     *
     * @return mixed
     */
    private function validateFileSize(): void
    {
        if ($this->getFileSize() > $this->getMaxFileSize()) {
            throw new Exception('Error: File size is larger than the allowed limit.');
        }
    }

    /**
     * Checks if the uploaded file type (example: jpg) is in the $allowedFileFormats[].
     *
     * @throws Exception if the file format is not allowed.
     *
     * @return mixed
     */
    private function validateFileType(): void
    {
        if (!in_array($this->getFileType(), $this->getAllowedFileFormats())) {
            throw new Exception('Error: Please select a valid file format.');
        }
    }

    /**
     * We set the uploaded files name, type, size - so these
     * parameters can be validated.
     *
     * @throws Exception
     *
     * @return mixed
     */
    private function setFileSizeNameType(): void
    {
        $uploadData = $this->getUploadData();
        if (isset($uploadData["photo"]) && $uploadData["photo"]["error"] == 0) {
            $this->setFileName($uploadData["photo"]["name"]);
            $this->setFileType($uploadData["photo"]["type"]);
            $this->setFileSize($uploadData["photo"]["size"]);
        } else {
            throw new Exception('Error with uploading: ' . $uploadData['photo']['error']);
        }
    }

    /**
     * Get the value of fileName
     * 
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * Set the value of fileName
     *
     * @return  self
     */
    public function setFileName($fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get the value of fileType
     * 
     * @return string
     */
    public function getFileType(): string
    {
        return $this->fileType;
    }

    /**
     * Set the value of fileType
     *
     * @return  self
     */
    public function setFileType($fileType): self
    {
        $this->fileType = $fileType;

        return $this;
    }

    /**
     * Get the value of fileSize
     * 
     * @return string
     */
    public function getFileSize(): string
    {
        return $this->fileSize;
    }

    /**
     * Set the value of fileSize
     *
     * @return  self
     */
    public function setFileSize($fileSize): self
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    /**
     * Get this is = to $_FILES now, we can treat $uploadData as the $_FILES
     *
     * @return array
     */
    public function getUploadData(): array
    {
        return $this->uploadData;
    }

    /**
     * Get the value of allowedFileFormats
     * 
     * @return string
     */
    public function getAllowedFileFormats(): string
    {
        return $this->allowedFileFormats;
    }

    /**
     * Get the maximum allowed size for the uploaded file.
     *
     * @return  float
     */
    public function getMaxFileSize(): float
    {
        return $this->maxFileSize;
    }
}
