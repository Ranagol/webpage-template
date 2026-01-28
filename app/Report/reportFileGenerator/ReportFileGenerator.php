<?php

namespace App\Report\ReportFileGenerator;

class ReportFileGenerator
{
    private string $reportFilePath;

    public function __construct(array $dataToDownload)
    {

    }

    private function createReportFile(array $dataToDownload): void
    {
        $email = $this->getUserEmail();
    }

    private function getUserEmail(): string
    {
        $user = User::getCurrentUser();
        if (!($user instanceof User)) {
            throw new Exception('User is not logged in.');
        }
        $email = $user->email;

        return $email;
    }

    /**
     * Get the value of reportFilePath
     */ 
    public function getReportFilePath(): string
    {
        return $this->reportFilePath;
    }
}
