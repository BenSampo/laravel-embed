<?php

namespace BenSampo\Embed\Services;

use DOMDocument;
use Illuminate\Support\Str;
use BenSampo\Embed\ServiceBase;
use BenSampo\Embed\ValueObjects\Url;
use Illuminate\Support\Facades\Http;

class Miro extends ServiceBase
{
    public static function detect(Url $url): bool
    {
        return Str::startsWith($url, [
            'https://miro.com/miroverse/category/',
        ]);
    }

    protected function viewData(): array
    {
        return [
            'iframeUrl' => $this->iframeUrl(),
        ];
    }

    protected function iframeUrl(): string
    {
        $html = Http::get($this->url)->body();

        libxml_use_internal_errors(true);
        $dom = new DOMDocument;
        $dom->loadHTML($html);
        return $dom->getElementsByTagName('iframe')[0]->getAttribute('src');
    }
}
