<?php

namespace BenSampo\Embed\Services;

use BenSampo\Embed\ServiceBase;
use BenSampo\Embed\ValueObjects\Url;

class YouTube extends ServiceBase
{
    public static function detect(Url $url): bool
    {
        $instance = new self($url);

        return $instance->videoId() !== null || $instance->playlistId() !== null;
    }

    protected function viewData(): array
    {
        return [
            'videoId' => $this->videoId(),
            'playlistId' => $this->playlistId(),
            'start' => $this->startTime(),
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
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/|youtube.com/shorts/)([^"&?/ ]{11})%i', $this->url, $match);

        if (array_key_exists(1, $match)) {
            return $match[1];
        }

        return null;
    }

    protected function playlistId(): ?string
    {
        preg_match('/[?&]list=([a-zA-Z0-9_-]+)/i', $this->url, $match);

        if (array_key_exists(1, $match)) {
            return $match[1];
        }

        return null;
    }

    protected function startTime(): string
    {
        preg_match('/[?&](?:t|start)=(\d+)(?:s)?/i', $this->url, $match);

        if (array_key_exists(1, $match)) {
            return $match[1];
        }

        return '0';
    }
}
