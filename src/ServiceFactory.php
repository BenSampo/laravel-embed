<?php

namespace BenSampo\Embed;

use Symfony\Component\Finder\Finder;
use BenSampo\Embed\Exceptions\ServiceNotFoundException;

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