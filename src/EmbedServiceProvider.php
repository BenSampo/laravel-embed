<?php

namespace BenSampo\Embed;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use BenSampo\Embed\ViewComponents\EmbedViewComponent;
use BenSampo\Embed\ViewComponents\StylesViewComponent;
use BenSampo\Embed\ViewComponents\ResponsiveWrapperViewComponent;

class EmbedServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('embed', EmbedViewComponent::class);
        Blade::component('embed-responsive-wrapper', ResponsiveWrapperViewComponent::class);
        Blade::component('embed-styles', StylesViewComponent::class);

	    $this->loadViewsFrom(__DIR__.'/../resources/views', 'embed');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/embed'),
        ]);
    }
}
