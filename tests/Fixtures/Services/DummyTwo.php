<?php

namespace BenSampo\Embed\Tests\Fixtures\Services;

use Illuminate\Support\Str;
use BenSampo\Embed\ServiceBase;

class DummyTwo extends ServiceBase
{
    public static function detect(string $url): bool
    {
        return Str::contains($url, 'https://dummy-two.com');
    }
}
