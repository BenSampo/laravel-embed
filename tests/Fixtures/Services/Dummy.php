<?php

namespace BenSampo\Embed\Tests\Fixtures\Services;

use Illuminate\Support\Str;
use BenSampo\Embed\ServiceBase;

class Dummy extends ServiceBase
{
    public static function detect(string $url): bool
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
