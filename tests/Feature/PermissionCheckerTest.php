<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Application;
use PHPUnit\Framework\TestCase;

class PermissionCheckerTest extends TestCase
{
    public function testAppCanCreateDirAndWriteToFile(): void
    {
        Application::bootstrap();

        // Define the path for the test directory in the app root
        $testDirPath = __DIR__ . '/../../permissionCheck';

        // Assert the directory does not exist before the test
        $this->assertDirectoryDoesNotExist($testDirPath, 'The permissionCheck directory should not exist before the test');

        // Create directory
        mkdir($testDirPath);

        // Create and write to file
        $testFile = $testDirPath . '/test.txt';
        $testContent = 'This is a test.';
        file_put_contents($testFile, $testContent);

        // Assert directory and file exist
        $this->assertDirectoryExists($testDirPath);
        $this->assertFileExists($testFile);
        $this->assertStringEqualsFile($testFile, $testContent);

        // Cleanup
        unlink($testFile);
        rmdir($testDirPath);
    }

    public function testAppDirectoriesAreWritable(): void
    {
        $dir = __DIR__ . '/../../storage/logs';

        $this->assertTrue(is_writable($dir), "Directory not writable: $dir");
    }
}
