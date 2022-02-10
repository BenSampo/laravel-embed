<?php

namespace BenSampo\Embed\Tests\Services;

use BenSampo\Embed\Services\Miro;
use BenSampo\Embed\Tests\Cases\ServiceTestCase;

class MiroTest extends ServiceTestCase
{
    public function setup(): void
    {
        $this->markTestSkipped('Miro seems to be unstable');

        parent::setUp();
    }
    
    /**
     * Overriding this test for Miro because it returns a different embed URL each time...
     */
    public function test_it_has_expected_view_data()
    {
        foreach ($this->expectedViewData() as $key => $value) {
            $this->assertStringStartsWith('https://miro.com/app/embed/', $this->service()->view()->getData()[$key]);
        }
    }
    
    protected function serviceClass(): string
    {
        return Miro::class;
    }
    
    protected function expectedViewName(): string
    {
        return 'miro';
    }

    protected function expectedViewData(): array
    {
        return [
            'iframeUrl' => 'https://miro.com/app/embed/o9J_kquX_s8=/?autoplay=yep',
        ];
    }

    protected function validUrls(): array
    {
        return [
            'https://miro.com/miroverse/category/workshops/remote-ux-workshops',
        ];
    }
}
