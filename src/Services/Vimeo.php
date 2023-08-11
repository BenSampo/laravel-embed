<?php

namespace BenSampo\Embed\Services;

use BenSampo\Embed\ServiceBase;
use BenSampo\Embed\ValueObjects\Url;

class Vimeo extends ServiceBase
{
    public static function detect(Url $url): bool
    {
        return (new self($url))->parseUrl() !== null;
    }

    protected function viewData(): array
    {
        return $this->parseUrl();
    }

    /**
     * @link https://stackoverflow.com/a/16841070/3498182
     */
    protected function parseUrl(): ?array
    {
        preg_match('/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})\/?([a-z0-9]+)?[?]?.*/', $this->url, $match);
        
        if (array_key_exists(5, $match)) {
            return [
                'videoId' => $match[5],
                'videoHash' => isset($match[6]) ? $match[6] : NULL
            ];
        }

        return null;
    }
}
