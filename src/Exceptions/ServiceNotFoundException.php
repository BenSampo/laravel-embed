<?php

namespace BenSampo\Embed\Exceptions;

use Exception;

class ServiceNotFoundException extends Exception
{
    public function __construct(string $url)
    {
        parent::__construct("Could not find an embed service to use for the url '$url'.");
    }
}
