<?php

namespace System\response\downloadResponse;

class DownloadResponse
{
    /**
     * Contains the data, which will be used to create a csv download response.
     *
     * @var array
     */
    private array $dataToDownload;

    public function __construct(array $dataToDownload)
    {
        $this->dataToDownload = $dataToDownload;
    }
    
    /**
     * Here we actually make the csv file download response. Aka we create a csv file, and we force
     * this csv file to be downloaded.
     * The source is://https://code.iamkate.com/php/creating-downloadable-csv-files/
     * 
     * @return void
     */
    public function sendResponse(): void
    {
        // output headers so that the file is downloaded rather than displayed
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');
        //sets response code to 200
        http_response_code(200);

        // create a file pointer connected to the output stream. So we create the csv file in the output, so it does not need a storage directory
        $output = fopen('php://output', 'w');

        // creates csv file, and writes into csv file the column names, which are Category and Cost.
        fputcsv($output, ['Category', 'Cost']);

        // writes into csv file, line by line. 
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
