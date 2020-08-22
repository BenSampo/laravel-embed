<?php

namespace BenSampo\Embed\Services;

use BenSampo\Embed\ServiceBase;
use BenSampo\Embed\ValueObjects\Url;

class Vimeo extends ServiceBase
{
    public static function detect(Url $url): bool
    {
        return (new self($url))->videoId() !== null;
    }

    protected function viewData(): array
    {
        return [
            'videoId' => $this->videoId(),
        ];
    }

    /**
     * @link https://stackoverflow.com/a/16841070/3498182
     */
    protected function videoId(): ?string
    {
        preg_match('/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/', $this->url, $match);

        if (array_key_exists(5, $match)) {
            return $match[5];
        }

        return null;
    }
}
