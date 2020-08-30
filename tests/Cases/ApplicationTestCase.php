<?php

namespace BenSampo\Embed\Tests\Cases;

use Orchestra\Testbench\TestCase;
use BenSampo\Embed\EmbedServiceProvider;

class ApplicationTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            EmbedServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['view']->addNamespace('embed', __DIR__ . '/../Fixtures/resources/views');
    }
}
