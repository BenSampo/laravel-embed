<?php

namespace BenSampo\Embed\Services;

use Illuminate\Support\Str;
use BenSampo\Embed\ServiceBase;
use BenSampo\Embed\ValueObjects\Url;

class GoogleMaps extends ServiceBase
{
    public static function detect(Url $url): bool
    {
        return Str::startsWith($url, [
            'https://www.google.com/maps/embed',
        ]);
    }

    protected function viewData(): array
    {
        return [
            'iframeUrl' => $this->iframeUrl(),
        ];
    }

    protected function viewName(): string
    {
        return 'googlemaps';
    }

    protected function iframeUrl(): string
    {
        return $this->url;
    }
}
