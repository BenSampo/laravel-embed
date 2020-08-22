<?php

namespace BenSampo\Embed\Services;

use BenSampo\Embed\ServiceBase;
use BenSampo\Embed\ValueObjects\Url;

class Fallback extends ServiceBase
{
    public static function detect(Url $url): bool
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
