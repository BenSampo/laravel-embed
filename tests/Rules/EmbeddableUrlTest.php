<?php

namespace BenSampo\Embed\Tests\Rules;

use BenSampo\Embed\Services\Miro;
use BenSampo\Embed\Services\Vimeo;
use BenSampo\Embed\Services\YouTube;
use BenSampo\Embed\Rules\EmbeddableUrl;
use Illuminate\Support\Facades\Validator;
use BenSampo\Embed\Tests\Cases\ApplicationTestCase;

class EmbeddableUrlTest extends ApplicationTestCase
{
    public function test_it_passes_a_validUrl_for_any_service()
    {
        $validUrls = [
            'https://www.dailymotion.com/video/xg4y8d',
            'https://dai.ly/xg4y8d',
            'https://miro.com/miroverse/category/workshops/remote-ux-workshops',
            'http://www.slideshare.net/haraldf/business-quotes-for-2011',
            'https://vimeo.com/148751763',
            'https://youtu.be/dQw4w9WgXcQ',
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
        ];

        foreach ($validUrls as $url) {
            $this->assertTrue((new EmbeddableUrl)->passes('', $url));
        }
    }

    public function test_it_passes_for_an_allowed_service()
    {
        $url = 'https://www.youtube.com/embed/dQw4w9WgXcQ';
        $allowedServices = [
            YouTube::class,
        ];
        
        $this->assertTrue(
            (new EmbeddableUrl)
                ->allowedServices($allowedServices)
                ->passes('', $url)
        );
    }

    public function test_it_passes_for_multiple_allowed_services()
    {
        $validUrls = [
            'https://www.youtube.com/embed/dQw4w9WgXcQ',
            'https://vimeo.com/148751763',
        ];
        $allowedServices = [
            YouTube::class,
            Vimeo::class,
        ];

        foreach ($validUrls as $url) {
            $this->assertTrue(
                (new EmbeddableUrl)
                    ->allowedServices($allowedServices)
                    ->passes('', $url)
            );
        }
    }

    public function test_it_fails_for_an_invalid_url()
    {
        $this->assertFalse(
            (new EmbeddableUrl)
                ->passes('', 'xyz')
        );
    }

    public function test_it_fails_for_an_unsupported_service()
    {
        $url = 'https://www.real.com/video/xg4y8d';
        $allowedServices = [
            YouTube::class,
        ];

        $this->assertFalse(
            (new EmbeddableUrl)
                ->allowedServices($allowedServices)
                ->passes('', $url)
        );
    }

    public function test_it_fails_for_service_not_in_allowed_list_single()
    {
        $url = 'https://www.youtube.com/embed/dQw4w9WgXcQ';
        $allowedServices = [
            Vimeo::class,
        ];

        $this->assertFalse(
            (new EmbeddableUrl)
                ->allowedServices($allowedServices)
                ->passes('', $url)
        );
    }

    public function test_it_fails_for_service_not_in_allowed_list_multiple()
    {
        $url = 'https://www.youtube.com/embed/dQw4w9WgXcQ';
        $allowedServices = [
            Vimeo::class,
            Miro::class,
        ];

        $this->assertFalse(
            (new EmbeddableUrl)
                ->allowedServices($allowedServices)
                ->passes('', $url)
        );
    }

    public function test_it_replaces_supported_services_in_message_with_no_services_specified()
    {
        $url = 'https://www.real.com/video/xg4y8d';
        $rule = new EmbeddableUrl;
        $expectedMessage = 'The url must be a URL from one of the following services: Dailymotion, GoogleMaps, Miro, Slideshare, Vimeo or YouTube.';

        $this->assertValidationMessage($url, $rule, $expectedMessage);
    }

    public function test_it_replaces_supported_service_in_message()
    {
        $url = 'https://www.real.com/video/xg4y8d';
        $rule = (new EmbeddableUrl)->allowedServices([YouTube::class]);
        $expectedMessage = 'The url must be a URL from one of the following services: YouTube.';

        $this->assertValidationMessage($url, $rule, $expectedMessage);
    }

    public function test_it_replaces_supported_services_list_in_message()
    {
        $url = 'https://www.real.com/video/xg4y8d';
        $rule = (new EmbeddableUrl)->allowedServices([YouTube::class, Vimeo::class, Miro::class]);
        $expectedMessage = 'The url must be a URL from one of the following services: Miro, Vimeo or YouTube.';

        $this->assertValidationMessage($url, $rule, $expectedMessage);
    }
    
    protected function assertValidationMessage($url, $rule, $expectedMessage)
    {
        $attributeKey = 'url';
        $validator = Validator::make(
            [$attributeKey =>  $url],
            [$attributeKey => $rule],
        );
        
        $this->assertEquals($expectedMessage, $validator->messages()->get($attributeKey)[0]);
    }
}
