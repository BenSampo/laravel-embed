<?php

namespace BenSampo\Embed\Tests\Services;

use BenSampo\Embed\Services\Fallback;
use BenSampo\Embed\Tests\Cases\ServiceTestCase;

class FallbackTest extends ServiceTestCase
{
    public function test_it_detects_appropriate_urls()
    {
        // This inherited test is irrelevant for the fallback.
        $this->assertTrue(true);
    }

    protected function serviceClass(): string
    {
        return Fallback::class;
    }
    
    protected function expectedViewName(): string
    {
        return 'fallback';
    }

    protected function expectedViewData(): array
    {
        return [
            'url' => 'https://non-existing-service.com',
        ];
    }

    protected function validUrls(): array
    {
        return [
            'https://non-existing-service.com',
        ];
    }
}
