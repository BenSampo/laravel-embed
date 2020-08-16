<?php

namespace BenSampo\Embed;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use BenSampo\Embed\ViewComponents\EmbedViewComponent;
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
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'embed');
    }
}
