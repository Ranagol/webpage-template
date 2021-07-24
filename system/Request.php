<?php

namespace System;

class Request extends AbstractRequest
{
    public function __construct()
    {
        $this->data = $_REQUEST;
    }
}
