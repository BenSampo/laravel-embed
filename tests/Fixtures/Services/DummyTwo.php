<?php

namespace BenSampo\Embed\Tests\Fixtures\Services;

use Illuminate\Support\Str;
use BenSampo\Embed\ServiceBase;
use BenSampo\Embed\ValueObjects\Url;

class DummyTwo extends ServiceBase
{
    public static function detect(Url $url): bool
    {
        return Str::contains($url, 'https://dummy-two.com');
    }
}
