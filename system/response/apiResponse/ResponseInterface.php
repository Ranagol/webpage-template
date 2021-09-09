<?php

namespace System\response\apiResponse;

interface ResponseInterface
{
    public static function send($data, int $code = 200);
}
