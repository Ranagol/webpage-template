<?php

namespace Tests\App\Models;

use App\Models\Upload;
use PHPUnit\Framework\TestCase;

final class UploadModelTest extends TestCase
{
    public function testUploadDataAndFileMetadataSettersGetters(): void
    {
        $uploadData = [
            'file' => [
                'name' => 'report.csv',
                'type' => 'text/csv',
                'size' => 1024,
                'error' => 0,
            ],
        ];

        $upload = new Upload($uploadData);
        $upload->setFileName('report.csv');
        $upload->setFileType('text/csv');
        $upload->setFileSize(1024.0);

        $this->assertSame($uploadData, $upload->getUploadData());
        $this->assertSame('report.csv', $upload->getFileName());
        $this->assertSame('text/csv', $upload->getFileType());
        $this->assertSame(1024.0, $upload->getFileSize());
        $this->assertContains('text/csv', $upload->getAllowedFileFormats());
        $this->assertGreaterThan(0, $upload->getMaxFileSize());
    }
}
