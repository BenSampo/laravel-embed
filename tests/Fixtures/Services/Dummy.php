<?php

namespace BenSampo\Embed\Tests\Fixtures\Services;

use Illuminate\Support\Str;
use BenSampo\Embed\ServiceBase;
use BenSampo\Embed\ValueObjects\Url;

class Dummy extends ServiceBase
{
    public static function detect(Url $url): bool
    {
        return Str::contains($url, 'https://dummy.com');
    }

    protected function viewData(): array
    {
        return [
            'foo' => 'bar',
        ];
    }
}
