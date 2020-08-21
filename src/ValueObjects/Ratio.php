<?php

namespace BenSampo\Embed\ValueObjects;

use InvalidArgumentException;

class Ratio
{
    public int $width;
    public int $height;

    public function __construct(string $ratio)
    {
        [$this->width, $this->height] = $this->parseRatioString($ratio);
    }

    public function asPercentage()
    {
        $percentage = $this->height / $this->width * 100;

        return (float) round($percentage, 2);
    }

    protected function parseRatioString(string $ratio): array
    {
        preg_match('/(.*[0-9].*):(.*[0-9].*)/', $ratio, $matches);

        if (count($matches) === 0) {
            throw new InvalidArgumentException("The provided ratio '$ratio' is invalid.");
        }
        
        return [
            $matches[1],
            $matches[2]
        ];
    }
}