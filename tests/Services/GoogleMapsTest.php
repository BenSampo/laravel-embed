<?php

namespace BenSampo\Embed\Tests\Services;

use BenSampo\Embed\Services\GoogleMaps;
use BenSampo\Embed\Tests\Cases\ServiceTestCase;

class GoogleMapsTest extends ServiceTestCase
{
    protected function serviceClass(): string
    {
        return GoogleMaps::class;
    }

    protected function expectedViewName(): string
    {
        return 'googlemaps';
    }

    protected function expectedViewData(): array
    {
        return [
            'iframeUrl' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2483.6803818653148!2d-0.12720032263547887!3d51.50073251118933!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487604c38c8cd1d9%3A0xb78f2474b9a45aa9!2sBig%20Ben!5e0!3m2!1sen!2suk!4v1683805199103!5m2!1sen!2suk',
            'label' => 'An embedded map',
        ];
    }

    protected function validUrls(): array
    {
        return [
            'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2483.6803818653148!2d-0.12720032263547887!3d51.50073251118933!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487604c38c8cd1d9%3A0xb78f2474b9a45aa9!2sBig%20Ben!5e0!3m2!1sen!2suk!4v1683805199103!5m2!1sen!2suk',
        ];
    }
}
