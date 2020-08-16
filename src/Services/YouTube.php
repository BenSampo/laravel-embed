<?php

namespace BenSampo\Embed\Services;

use BenSampo\Embed\ServiceBase;

class YouTube extends ServiceBase
{
    public static function detect(string $url): bool
    {
        return (new self($url))->videoId() !== null;
    }

    protected function viewData(): array
    {
        return [
            'videoId' => $this->videoId(),
        ];
    }

    protected function viewName(): string
    {
        return 'youtube';
    }

    /**
     * @link https://stackoverflow.com/a/6382259/3498182
     */
    protected function videoId(): ?string
    {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $this->url, $match);

        if (array_key_exists(1, $match)) {
            return $match[1];
        }

        return null;
    }
}
