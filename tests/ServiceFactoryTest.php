<?php

namespace BenSampo\Embed\Tests;

use BenSampo\Embed\ServiceFactory;
use BenSampo\Embed\ValueObjects\Url;
use BenSampo\Embed\Services\Fallback;
use BenSampo\Embed\Tests\Fixtures\Services\Dummy;
use BenSampo\Embed\Tests\Cases\ApplicationTestCase;
use BenSampo\Embed\Tests\Fixtures\Services\DummyTwo;
use BenSampo\Embed\Exceptions\ServiceNotFoundException;

class ServiceFactoryTest extends ApplicationTestCase
{
    public function test_it_can_get_a_service_by_url()
    {
        ServiceFactory::fake();

        $this->assertInstanceOf(Dummy::class, ServiceFactory::getByUrl(new Url('https://dummy.com')));
        $this->assertInstanceOf(DummyTwo::class, ServiceFactory::getByUrl(new Url('https://dummy-two.com')));
    }

    public function test_it_throws_an_exception_if_no_service_exists_to_handle_the_url()
    {
        ServiceFactory::fake();
        
        $this->expectException(ServiceNotFoundException::class);

        ServiceFactory::getByUrl(new Url('https://non-existing-service.com'));
    }

    public function test_it_can_get_a_fallback_service()
    {
        $this->assertInstanceOf(Fallback::class, ServiceFactory::getFallback(new Url('https://non-existing-service.com')));
    }
}
