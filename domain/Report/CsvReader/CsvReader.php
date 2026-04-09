<?php

declare(strict_types=1);

namespace Domain\Report\CsvReader;

use App\Logger\Logger;
use Domain\Report\ReportDomain\Amount;
use Domain\Report\ReportDomain\Category;
use Domain\Report\ReportDomain\CsvFile;
use Domain\Report\ReportDomain\Line;
use Domain\Report\ReportDomain\Price;

class CsvReader
{
    private const MAX_CSV_ROWS = 10000;

    /**
     * Stores the file path.
     */
    private string $fileNameWithPath;

    /**
     * We store here the opened file. This will be used for further file manage operations.
     *
     * @var resource|null
     */
    private $filePointer;

    private CsvFile $csvFile;

    public function process(string $email, string $fileName): void
    {
        $this->createFilePath($email, $fileName);
        $this->createFilePointer();
        $this->readCsvFile();
    }

    /**
     * Get the value of csvFile.
     */
    public function getCsvFile(): CsvFile
    {
        return $this->csvFile;
    }

    /**
     * Get the value of fileNameWithPath.
     */
    private function getFileNameWithPath(): string
    {
        return $this->fileNameWithPath;
    }

    /**
     * Get the value of filePointer.
     */
    private function getFilePointer(): mixed
    {
        return $this->filePointer;
    }

    /**
     * https://stackoverflow.com/questions/1269562/how-to-create-an-array-from-a-csv-file-using-php-and-the-fgetcsv-function.
     */
    private function readCsvFile(): void
    {
        $lines = [];
        $rowCount = 0;

        try {

            // this is how we can read csv file line by line. The result will be an array o arrays.
            while (($lineFromCsv = fgetcsv($this->getFilePointer())) !== false) {
                ++$rowCount;
                if ($rowCount > self::MAX_CSV_ROWS) {
                    throw new \Exception('CSV file is too large to process safely.');
                }

                // $lineFromCsv is an array of the csv elements
                // print_r($lineFromCsv);
                $priceValue = $lineFromCsv[1] ?? null;
                $amountValue = $lineFromCsv[2] ?? null;

                if (!is_numeric($priceValue) || !is_numeric($amountValue)) {
                    continue;
                }

                $category = new Category((string) ($lineFromCsv[0] ?? ''));
                $price = new Price((float) $priceValue);
                $amount = new Amount((float) $amountValue);
                $line = new Line($category, $price, $amount);
                $lines[] = $line;
            }

        } catch (\Throwable $e) {
            // Log detailed internals, but do not dump them to users.
            if ($e instanceof \Exception) {
                Logger::getInstance()->logError($e);
            } else {
                Logger::getInstance()->logError(new \Exception($e->getMessage(), 0, $e));
            }

            throw new \Exception('Could not process uploaded CSV file.', 0, $e);

        } finally {
            $fp = $this->getFilePointer();
            if (is_resource($fp)) {
                fclose($fp);
            }
        }

        $csvFile = new CsvFile($this->getFileNameWithPath(), $lines);

        $this->csvFile = $csvFile;
    }

    private function createFilePointer(): void
    {
        clearstatcache(); // deleting cached stuff
        if (file_exists($this->getFileNameWithPath())) {
            $fp = fopen($this->getFileNameWithPath(), 'r'); // opening a file
            if ($fp !== false) {
                $this->filePointer = $fp;
            } else {
                throw new \Exception('Could not open uploaded CSV file.');
            }
        } else {
            throw new \Exception('Uploaded CSV file not found.');
        }
    }

    private function createFilePath(string $email, string $fileName): void
    {
        $safeFileName = basename($fileName);
        $path = __DIR__ . '/../../../storage/upload/' . $email . '/' . $safeFileName;

        $this->fileNameWithPath = $path;
    }
}
