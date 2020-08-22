<?php

namespace BenSampo\Embed\ValueObjects;

use Illuminate\Support\Str;
use InvalidArgumentException;

class Url
{
    protected string $url;

    public function __construct(string $url)
    {
        if (! Str::startsWith($url, ['http://', 'https://'])) {
            $url = 'https://' . $url;
        };

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException("The URL $url is invalid.");
        }
        
        $this->url = $url;
    }

    public function __toString(): string
    {
        return $this->url;
    }
}