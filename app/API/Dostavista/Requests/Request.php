<?php

namespace App\API\Dostavista\Requests;

abstract class Request
{
    public function getMethod()
    {
        return $this->method;
    }

    public function getUri()
    {
        return $this->uri;
    }
}
