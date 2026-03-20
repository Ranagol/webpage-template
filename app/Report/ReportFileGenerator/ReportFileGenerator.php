<?php

namespace App\Report\ReportFileGenerator;

use App\Models\User;

class ReportFileGenerator
{
    private ?string $reportFilePath = null;

    private function getUserEmail(): string
    {
        $user = User::getCurrentUser();
        if (!$user instanceof User) {
            throw new \Exception('User is not logged in.');
        }
        $email = $user->email;

        return $email;
    }

    /**
     * Get the value of reportFilePath.
     */
    public function getReportFilePath(): string
    {
        if (null === $this->reportFilePath) {
            $this->reportFilePath = __DIR__ . '/../../../storage/upload/' . $this->getUserEmail() . '/report.csv';
        }

        return $this->reportFilePath;
    }
}
