<?php

namespace BenSampo\Embed\Services;

use BenSampo\Embed\ServiceBase;

class Fallback extends ServiceBase
{
    public static function detect(string $url): bool
    {
        return false;
    }

    protected function viewData(): array
    {
        return [
            'url' => $this->url,
        ];
    }
}
