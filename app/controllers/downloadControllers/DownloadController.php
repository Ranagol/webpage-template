<?php

namespace App\Controllers\DownloadControllers;

use System\request\RequestInterface;

class DownloadController
{
    public function download(RequestInterface $request): void
    {
        $dataToDownload = $request->getAllRequestData();

        //https://code.iamkate.com/php/creating-downloadable-csv-files/
        // output headers so that the file is downloaded rather than displayed
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=data.csv');

        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');

        // output the column headings
        fputcsv($output, $dataToDownload);

        foreach ($dataToDownload as $line) {
            fputcsv($output, $line);
        }


        $r = 5;

    }
}
