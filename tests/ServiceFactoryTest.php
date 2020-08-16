<?php

namespace BenSampo\Embed\Tests;

use BenSampo\Embed\ServiceFactory;
use BenSampo\Embed\Tests\Fixtures\Services\Dummy;
use BenSampo\Embed\Tests\Cases\ApplicationTestCase;
use BenSampo\Embed\Tests\Fixtures\Services\DummyTwo;
use BenSampo\Embed\Exceptions\ServiceNotFoundException;
use BenSampo\Embed\Tests\Fakes\ServiceFactoryFake;

class ServiceFactoryTest extends ApplicationTestCase
{
    public function test_it_can_get_a_service_by_url()
    {
        $this->swap(ServiceFactory::class, new ServiceFactoryFake);

        $this->assertInstanceOf(Dummy::class, ServiceFactory::getByUrl('https://dummy.com'));
        $this->assertInstanceOf(DummyTwo::class, ServiceFactory::getByUrl('https://dummy-two.com'));
    }

    public function test_it_throws_an_exception_if_no_service_exists_to_handle_the_url()
    {
        $this->swap(ServiceFactory::class, new ServiceFactoryFake);
        
        $this->expectException(ServiceNotFoundException::class);

        ServiceFactory::getByUrl('https://unknown-service.com');
    }
}
