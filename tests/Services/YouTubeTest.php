<?php

namespace BenSampo\Embed\Tests\Services;

use BenSampo\Embed\Services\YouTube;
use BenSampo\Embed\Tests\Cases\ServiceTestCase;

class YouTubeTest extends ServiceTestCase
{
    protected function serviceClass(): string
    {
        return YouTube::class;
    }
    
    protected function expectedViewName(): string
    {
        return 'youtube';
    }

    protected function expectedViewData(): array
    {
        return [
            'videoId' => 'dQw4w9WgXcQ',
            'start' => '0',
            'label' => 'An embedded video',
        ];
    }

    protected function validUrls(): array
    {
        return [
            'https://youtu.be/dQw4w9WgXcQ',
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'https://www.youtube.com/?v=dQw4w9WgXcQ',
            'https://www.youtube.com/v/dQw4w9WgXcQ',
            'https://www.youtube.com/e/dQw4w9WgXcQ',
            'https://www.youtube.com/user/username#p/u/11/dQw4w9WgXcQ',
            'https://www.youtube.com/sandalsResorts#p/c/54B8C800269D7C1B/0/dQw4w9WgXcQ',
            'https://www.youtube.com/watch?feature=player_embedded&v=dQw4w9WgXcQ',
            'https://www.youtube.com/?feature=player_embedded&v=dQw4w9WgXcQ',
        ];
    }
}
