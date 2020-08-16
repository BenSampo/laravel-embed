<?php

namespace BenSampo\Embed\Tests\Services;

use BenSampo\Embed\Services\Vimeo;
use BenSampo\Embed\Tests\Cases\ServiceTestCase;

class VimeoTest extends ServiceTestCase
{
    protected function serviceClass(): string {
        return Vimeo::class;
    }
    
    protected function expectedViewName(): string {
        return 'vimeo';
    }

    protected function expectedViewData(): array {
        return [
            'videoId' => '148751763',
        ];
    }

    protected function validUrls(): array
    {
        return [
            'https://vimeo.com/148751763',
        ];
    }
}
