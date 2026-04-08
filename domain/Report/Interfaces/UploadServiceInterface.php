<?php

declare(strict_types=1);

namespace Domain\Report\Interfaces;

use Domain\Report\ReportDomain\CsvFile;

interface UploadServiceInterface
{
    /**
     * @param array<string, mixed> $uploadData
     */
    public function setUploadData(array $uploadData): void;

    public function storeFile(): CsvFile;

    public function checkCsrfToken(?string $csrfToken): void;
}
