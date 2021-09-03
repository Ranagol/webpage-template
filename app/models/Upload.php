<?php

namespace App\Models;

use Exception;
use App\models\User;
use App\Report\CsvReader\CsvReader;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    /**
     *  this is = to $_FILES now, we can treat $uploadData as the $_FILES
     *
     * @var array
     */
    private $uploadData;

    /**
     * All the allowed upload formats are stored here.
     * The 'application/vnd.ms-excel' means .csv file.
     *
     * @var array
     */
    private $allowedFileFormats = [
        'image/jpg',
        'image/jpeg',
        'image/gif',
        'image/png',
        'application/vnd.ms-excel'
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
    //TODO nem jobb mindig float ot mondani integer helyett ilyen szituban? Hisz integer mindig lehet float, de float soha nem lesz integer...
    private $maxFileSize = 5 * 1024 * 1024;

    public function __construct(array $uploadData)
    {
        $this->uploadData = $uploadData;
    }

    /**
     * This is the central, main function that calls all other functions
     * regarding the file uploading. Now, the process is same for images and csv files - almost. The
     * only difference is, that if we are uploading a csv file, then we need to process it, once the
     * upload is successfull.
     *
     * @return void
     */
    public function storeFile(): void
    {
        $this->setFileSizeNameType();
        $this->validateFileType();
        $this->validateFileSize();
        $this->putFileIntoStorage();
        //from here this code is only in case of uploaded .csv files
        $this->activateCsvProcessing();
    }

    public function activateCsvProcessing(): void
    {
        //finds and reads the uploaded .csv file
        if ($this->getFileType() === 'application/vnd.ms-excel') {
            $csvFile = new CsvReader($this->getUserEmail(), $this->getFileName());
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
     *
     * @return void
     */
    private function putFileIntoStorage(): void
    {
        //get user email - this will be the name of his private storage
        $email = $this->getUserEmail();

        //create directory for the upload if there is none yet
        clearstatcache();//deleting cached stuff
        if (!file_exists(__DIR__ . '/../../storage/upload/' . $email)) {
            $boolean = mkdir(__DIR__ . '/../../storage/upload/' . $email);
            if (!$boolean) {
                throw new Exception('We could not make a new directory for the uploaded file.');
            }
        }

        //check if there is already a same file uploaded, and if so delete the previous file
        clearstatcache();//deleting cached stuff
        $path = __DIR__ . '/../../storage/upload/' . $this->getUserEmail() . '/' . $this->getFileName();
        if (file_exists($path)) {
            // echo 'file exists';
            \unlink($path);
        }

        //place the uploaded file into the new dir
        try {
            $report = move_uploaded_file(
                $_FILES["file"]["tmp_name"],
                __DIR__ . '/../../storage/upload/' . $email . '/' . $this->getFileName()
            );
        } catch (Exception $error) {
            echo $error->getErrorMessage();
        }
    }

    public function getUserEmail(): string
    {
        $user = User::getCurrentUser();
        if (!($user instanceof User)) {
            throw new Exception('User is not logged in.');
        }
        $email = $user->email;

        return $email;
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
        if (isset($uploadData["file"]) && $uploadData["file"]["error"] == 0) {
            $this->setFileName($uploadData["file"]["name"]);
            $this->setFileType($uploadData["file"]["type"]);
            $this->setFileSize($uploadData["file"]["size"]);
        } else {
            throw new Exception('Error with uploading: ' . $uploadData['file']['error']);
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
     * @return array
     */
    public function getAllowedFileFormats(): array
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
