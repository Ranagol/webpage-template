<?php

namespace System\response;

//TODO LOSI hogyan csinaljam meg a a WebResponse klasszát? Van értelme egyáltalán?
//Más módon kérdezve ugyanaz: az api response készítéséhez van ApiResponse klasszám. 
//Mit csináljak a sima web response készítéshez, milyen klasszát?
interface ResponseInterface
{
    public static function send($data, int $code = 200);
}
