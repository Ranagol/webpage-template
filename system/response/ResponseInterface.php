<?php

namespace System\response;

interface ResponseInterface
{
    public static function send($data, int $code = 200);
}
