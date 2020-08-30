<?php

namespace BenSampo\Embed\Rules;

use BenSampo\Embed\ServiceFactory;
use BenSampo\Embed\ValueObjects\Url;
use Illuminate\Contracts\Validation\Rule;
use BenSampo\Embed\Exceptions\ServiceNotFoundException;
use BenSampo\Embed\Services\Fallback;

class EmbeddableUrl implements Rule
{
    protected array $allowedServices = [];
    protected ServiceFactory $serviceFactory;

    public function __construct()
    {
        $this->serviceFactory = new ServiceFactory;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            $url = new Url($value);
            $service = $this->serviceFactory::getByUrl($url);
        } catch (ServiceNotFoundException $th) {
            return false;
        }

        if (count($this->allowedServices) === 0) {
            return true;
        }
        
        return collect($this->allowedServices)
            ->filter(fn ($allowedService) => $service instanceof $allowedService)
            ->count() > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $allowedServiceClasses = count($this->allowedServices) > 0 ? $this->allowedServices : $this->serviceFactory->serviceClasses();
        $commaSeparatedServiceNames = collect($allowedServiceClasses)
            ->reject(fn ($serviceClass) => $serviceClass === Fallback::class)
            ->map(fn ($serviceClass) => class_basename($serviceClass))
            ->sort()
            ->join(', ', ' or ');

        return "The :attribute must be a URL from one of the following services: $commaSeparatedServiceNames.";
    }

    public function allowedServices(array $services): self
    {
        $this->allowedServices = $services;

        return $this;
    }
}
