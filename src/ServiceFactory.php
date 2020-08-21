<?php

namespace BenSampo\Embed;

use Symfony\Component\Finder\Finder;
use BenSampo\Embed\Tests\Fakes\ServiceFactoryFake;
use BenSampo\Embed\Exceptions\ServiceNotFoundException;
use BenSampo\Embed\Services\Fallback;

class ServiceFactory
{
    protected $serviceClassesPath =  __DIR__ . '/Services';
    protected $serviceClassesNamespace =  "BenSampo\Embed\Services\\";

    public static function getByUrl(string $url): ServiceContract
    {
        $factory = self::resolve();

        foreach ($factory->serviceClasses() as $serviceClass) {
            if ($serviceClass::detect($url)) {
                return new $serviceClass($url);
            };
        }

        throw new ServiceNotFoundException($url);
    }

    public static function getFallback(string $url): ServiceContract
    {
        return new Fallback($url);
    }

    public static function fake(): void
    {
        app()->instance(ServiceFactory::class, new ServiceFactoryFake);
    }

    protected static function resolve(): self
    {
        return resolve(self::class);
    }

    protected function serviceClasses(): array
    {
        $directoryIterator = (new Finder)
            ->files()
            ->in($this->serviceClassesPath)
            ->name('*.php')
            ->getIterator();
        $serviceClasses = [];

        foreach ($directoryIterator as $file) {
            $serviceClasses[] = $this->serviceClassesNamespace . $file->getFilenameWithoutExtension();
        }

        return $serviceClasses;
    }
}