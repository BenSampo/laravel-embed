<?php

namespace BenSampo\Embed\Tests\Fakes;

use BenSampo\Embed\ServiceFactory;

class ServiceFactoryFake extends ServiceFactory
{
    protected $serviceClassesPath =  __DIR__ . '/../Fixtures/Services';
    protected $serviceClassesNamespace =  "BenSampo\Embed\Tests\Fixtures\Services\\";
}