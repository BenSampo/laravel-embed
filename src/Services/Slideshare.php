<?php

namespace BenSampo\Embed\Services;

use DOMDocument;
use Illuminate\Support\Str;
use BenSampo\Embed\ServiceBase;
use BenSampo\Embed\ValueObjects\Url;
use Illuminate\Support\Facades\Http;

class Slideshare extends ServiceBase
{
    public static function detect(Url $url): bool
    {
        return Str::startsWith($url, [
            'http://www.slideshare.net',
            'https://www.slideshare.net',
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
        $OEmbedHtml = Http::get("https://www.slideshare.net/api/oembed/2?url={$this->url}&format=json")->json()['html'];

        $dom = new DOMDocument;
        $dom->loadHTML($OEmbedHtml);
        return $dom->getElementsByTagName('iframe')[0]->getAttribute('src');
    }
}
