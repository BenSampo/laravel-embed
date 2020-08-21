<?php

namespace BenSampo\Embed\Tests\Cases;

use BenSampo\Embed\ServiceContract;

abstract class ServiceTestCase extends ApplicationTestCase
{
    abstract protected function serviceClass(): string;
    
    abstract protected function expectedViewName(): string;

    abstract protected function expectedViewData(): array;

    abstract protected function validUrls(): array;

    protected function service(): ServiceContract
    {
        $serviceClass = $this->serviceClass();
        return new $serviceClass($this->validUrls()[0]);
    }

    public function test_it_renders_the_correct_view()
    {
        $this->assertEquals('embed::services.' . $this->expectedViewName(), $this->service()->view()->name());
    }

    public function test_it_detects_appropriate_urls()
    {
        foreach($this->validUrls() as $url) {
            $this->assertTrue($this->service()->detect($url));
        }
    }

    public function test_it_has_expected_view_data()
    {
        foreach ($this->expectedViewData() as $key => $value) {
            $this->assertEquals($value, $this->service()->view()->getData()[$key]);
        }
    }
}
