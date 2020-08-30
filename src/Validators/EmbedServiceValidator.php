<?php

namespace BenSampo\Embed\Validators;

use Illuminate\Support\Str;
use BenSampo\Embed\ServiceFactory;
use BenSampo\Embed\ValueObjects\Url;
use Illuminate\Validation\Validator;
use BenSampo\Embed\Exceptions\ServiceNotFoundException;


class EmbedServiceValidator
{
	function validate(string $attribute, $value, array $supportedServices, Validator $validator)
	{
		try {
			$url = new Url($value);
			$service = ServiceFactory::getByUrl($url);
		} catch (ServiceNotFoundException $th) {
			return false;
		}

		if (count($supportedServices) === 0) {
			return true;
		} 

		$serviceName = Str::of(class_basename($service))->kebab()->lower()->__toString();
		return in_array($serviceName, $supportedServices);
	}


	function replacer(string $message, string $attribute, string $rule, array $supportedServices, Validator $validator)
	{
		$supportedServices = array_map([Str::class, 'studly'], $supportedServices);

		if (count($supportedServices) === 0) {
			$servicesString = _('a supported service');
		} else {
			if (count($supportedServices) === 1) {
				$servicesString = $supportedServices[0];
			} else {
				$last = array_pop($supportedServices);
				$servicesString = implode(', ', $supportedServices) .' '. _('or') .' '. $last;
			}
		}

		return str_replace(':services', $servicesString, $message);
	}
}