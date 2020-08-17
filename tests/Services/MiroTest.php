<?php

namespace BenSampo\Embed\Tests\Services;

use BenSampo\Embed\Services\Miro;
use BenSampo\Embed\Tests\Cases\ServiceTestCase;

class MiroTest extends ServiceTestCase
{
    protected function serviceClass(): string {
        return Miro::class;
    }
    
    protected function expectedViewName(): string {
        return 'miro';
    }

    protected function expectedViewData(): array {
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
