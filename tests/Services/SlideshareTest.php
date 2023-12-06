<?php

namespace BenSampo\Embed\Tests\Services;

use BenSampo\Embed\Services\Slideshare;
use BenSampo\Embed\Tests\Cases\ServiceTestCase;

class SlideshareTest extends ServiceTestCase
{
    protected function serviceClass(): string
    {
        return Slideshare::class;
    }
    
    protected function expectedViewName(): string
    {
        return 'slideshare';
    }

    protected function expectedViewData(): array
    {
        return [
            'iframeUrl' => 'https://www.slideshare.net/slideshow/embed_code/key/6PCWPGFw9SwsAY',
            'label' => 'An embedded video',
        ];
    }

    protected function validUrls(): array
    {
        return [
            'http://www.slideshare.net/haraldf/business-quotes-for-2011',
            'https://www.slideshare.net/haraldf/business-quotes-for-2011',
        ];
    }
}
