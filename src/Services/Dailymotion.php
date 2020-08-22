<?php

namespace BenSampo\Embed\Services;

use BenSampo\Embed\ServiceBase;
use BenSampo\Embed\ValueObjects\Url;

class Dailymotion extends ServiceBase
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
     * @link https://github.com/OpenCode/awesome-regex#dailymotion
     */
    protected function videoId(): ?string
    {
        preg_match('/^https?:\/\/(?:www\.)?(?:dai\.ly\/|dailymotion\.com\/(?:.+?video=|(?:video|hub)\/))([a-z0-9]+)/i', $this->url, $match);

        if (array_key_exists(1, $match)) {
            return $match[1];
        }

        return null;
    }
}
