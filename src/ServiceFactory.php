<?php

namespace BenSampo\Embed;

use BenSampo\Embed\ValueObjects\Url;
use Symfony\Component\Finder\Finder;
use BenSampo\Embed\Services\Fallback;
use Illuminate\Support\Facades\Cache;
use BenSampo\Embed\Tests\Fakes\ServiceFactoryFake;
use BenSampo\Embed\Exceptions\ServiceNotFoundException;

class ServiceFactory
{
    protected $serviceClassesPath =  __DIR__ . '/Services';
    protected $serviceClassesNamespace =  "BenSampo\Embed\Services\\";

    public static function getByUrl(Url $url): ServiceContract
    {
        $factory = self::resolve();
        $cacheKey = 'larevel-embed-service::' . $url;

        if (Cache::has($cacheKey)) {
            $serviceClass = Cache::get($cacheKey);
            return new $serviceClass($url);
        }

        foreach ($factory->serviceClasses() as $serviceClass) {
            if ($serviceClass::detect($url)) {
                Cache::forever($cacheKey, $serviceClass);
                return new $serviceClass($url);
            };
        }

        throw new ServiceNotFoundException($url);
    }

    public static function getFallback(Url $url): ServiceContract
    {
        return new Fallback($url);
    }

    public static function fake(): void
    {
        app()->instance(ServiceFactory::class, new ServiceFactoryFake);
    }

    public function serviceClasses(): array
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

    protected static function resolve(): self
    {
        return resolve(self::class);
    }
}