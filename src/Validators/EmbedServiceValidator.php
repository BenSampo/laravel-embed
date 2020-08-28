<?php

namespace BenSampo\Embed\Validators;

use BenSampo\Embed\Exceptions\ServiceNotFoundException;
use BenSampo\Embed\ServiceFactory;
use BenSampo\Embed\ValueObjects\Url;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;


class EmbedServiceValidator
{
	function validate(string $attribute, $value, array $parameters, Validator $validator)
	{
		$url = new Url($value);

		try {
			$service = ServiceFactory::getByUrl($url);
		} catch (ServiceNotFoundException $th) {
			return false;
		}

		$supported_services = $parameters;
		if (count($supported_services) === 0) { // No constraint on which services
			return true;
		} else {
			$service_name = Str::of(class_basename($service))->kebab()->lower()->__toString();
			return in_array($service_name, $supported_services);
		}
	}


	function replacer(string $message, string $attribute, string $rule, array $parameters, Validator $validator)
	{
		$supported_services = $parameters;
		$supported_services = array_map([Str::class, 'studly'], $supported_services);

		if (count($supported_services) === 0) {
			$services_string = _('a supported service');
		} else {
			if (count($supported_services) === 1) {
				$services_string = $supported_services[0];
			} else {
				$last = array_pop($supported_services);
				$services_string = implode(', ', $supported_services) .' '. _('or') .' '. $last;
			}
		}

		return str_replace(':services', $services_string, $message);
	}
}