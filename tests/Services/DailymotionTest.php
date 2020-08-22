<?php

namespace BenSampo\Embed\Tests\Services;

use BenSampo\Embed\Services\Dailymotion;
use BenSampo\Embed\Tests\Cases\ServiceTestCase;

class DailymotionTest extends ServiceTestCase
{
    protected function serviceClass(): string
    {
        return Dailymotion::class;
    }
    
    protected function expectedViewName(): string
    {
        return 'dailymotion';
    }

    protected function expectedViewData(): array
    {
        return [
            'videoId' => 'xg4y8d',
        ];
    }

    protected function validUrls(): array
    {
        return [
            'https://www.dailymotion.com/video/xg4y8d',
            'https://www.dailymotion.com/video/xg4y8d?playlist=x6ncdj',
            'https://dai.ly/xg4y8d',
        ];
    }
}
