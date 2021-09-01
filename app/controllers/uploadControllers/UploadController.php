<?php

namespace App\Controllers\UploadControllers;

use Exception;
use App\Models\Image;
use System\request\RequestInterface;
use App\Controllers\UploadControllers\UploadController;

class UploadController
{
    //TODO LOSI A CsvUploadController és az ImageUploadController statikus metódokkal dolgozik.
    //mert a router dependency a statikus metódokat preferálja.
    //most jutottam el addig a pontig, hogy mivel sok hasonlatosság van a CsvUploadController és a
    //ImageUploadController között, ezért szeretnék csinálni egy közös parent klasszát. De minden method 
    //statikus. Ehhhm, hogyan tovább?
}
