<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\models\User;
use Exception;

class File extends Model
{
    /**
     *  this is = to $_FILES now, we can treat $uploadData as the $_FILES
     *
     * @var [type]
     */
    private $uploadData;

    private $allowedFileFormats = [
        'image/jpg', 
        'image/jpeg', 
        'image/gif', 
        'image/png'
    ];

    private $fileName;

    private $fileType;

    /**
     * The size of the uploaded file.
     *
     * @var [type]
     */
    private $fileSize;

    /**
     * The maximum allowed size for the uploaded file.
     *
     * @var [type]
     */
    private $maxFileSize = 5 * 1024 * 1024;

    public function __construct(Array $uploadData)
    {
        $this->uploadData = $uploadData;
    }

    /**
     * This is the central, main function that calls all other functions
     * regarding the file uploading.
     *
     * @return void
     */
    public function storeFile()
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
    private function putFileIntoStorage()
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
        $report = move_uploaded_file(
            $_FILES["photo"]["tmp_name"], 
            // __DIR__ . '/../../storage/upload/' . $email . '/' . $this->getFileName()
            '/storage/upload/' 
            . $email 
            . '/' 
            . $this->getFileName()
        );
        if (!$report) {
            throw new Exception('We could not move the file to its final destination.');
        }
        $t = 4;
    }

    /**
     * Validates the uploaded file size. It has to be smaller than 5MB.
     *
     * @return void
     */
    private function validateFileSize()
    {
        if($this->getFileSize() > $this->getMaxFileSize()) {
            throw new Exception('Error: File size is larger than the allowed limit.');
        }
    }

    /**
     * Checks if the uploaded file type (example: jpg) is in the $allowedFileFormats[].
     *
     * @throws Exception if the file format is not allowed.
     */
    private function validateFileType()
    {
        if(!in_array($this->getFileType(), $this->getAllowedFileFormats())) {
            throw new Exception('Error: Please select a valid file format.');
        }
    }

    /**
     * We set the uploaded files name, type, size - so these
     * parameters can be validated.
     *
     * @return void
     * @throws Exception When blabla is not whatever.
     */
    private function setFileSizeNameType()
    {
        $uploadData = $this->getUploadData();
        $c = 6;
        if(isset($uploadData["photo"]) && $uploadData["photo"]["error"] == 0){
            $this->setFileName($uploadData["photo"]["name"]);
            $this->setFileType($uploadData["photo"]["type"]);
            $this->setFileSize($uploadData["photo"]["size"]);
            $a = 5;
        } else {
            throw new Exception('Error with uploading: ' . $uploadData['photo']['error']);
        }
    }

    /**
     * Get the value of fileName
     */ 
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set the value of fileName
     *
     * @return  self
     */ 
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get the value of fileType
     */ 
    public function getFileType()
    {
        return $this->fileType;
    }

    /**
     * Set the value of fileType
     *
     * @return  self
     */ 
    public function setFileType($fileType)
    {
        $this->fileType = $fileType;

        return $this;
    }

    /**
     * Get the value of fileSize
     */ 
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * Set the value of fileSize
     *
     * @return  self
     */ 
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    /**
     * Get this is = to $_FILES now, we can treat $uploadData as the $_FILES
     *
     * @return  [type]
     */ 
    public function getUploadData()
    {
        return $this->uploadData;
    }

    /**
     * Get the value of errorMessage
     */ 
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Set the value of errorMessage
     *
     * @return  self
     */ 
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;

        return $this;
    }

    /**
     * Get the value of allowedFileFormats
     */ 
    public function getAllowedFileFormats()
    {
        return $this->allowedFileFormats;
    }

    /**
     * Get the maximum allowed size for the uploaded file.
     *
     * @return  [type]
     */ 
    public function getMaxFileSize()
    {
        return $this->maxFileSize;
    }
}
