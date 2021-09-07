<?php

namespace System\response\downloadResponse;

class DownloadResponse
{
    private array $dataToDownload;

    public function __construct(array $dataToDownload)
    {
        $this->dataToDownload = $dataToDownload;
    }

    
    public function sendResponse()
    {
        //https://code.iamkate.com/php/creating-downloadable-csv-files/
        // output headers so that the file is downloaded rather than displayed
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');
        http_response_code(200);
        // create a file pointer connected to the output stream. So we create the csv file in the output, so it does not need a storage directory
        $output = fopen('php://output', 'w');

        // output the column headings
        // fputcsv($output, ['Category', 'Cost']);


        foreach ($this->getDataToDownload() as $category => $cost) {
            $line = [$category, $cost];
            fputcsv($output, $line);
        }
    }

    /**
     * Get the value of dataToDownload
     */ 
    public function getDataToDownload(): array
    {
        return $this->dataToDownload;
    }
}
