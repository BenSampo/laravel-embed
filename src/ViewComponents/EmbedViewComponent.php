<?php

namespace BenSampo\Embed\ViewComponents;

use Illuminate\View\Component;
use BenSampo\Embed\ServiceFactory;
use BenSampo\Embed\ServiceContract;
use BenSampo\Embed\ValueObjects\Url;
use BenSampo\Embed\ValueObjects\Ratio;
use BenSampo\Embed\Exceptions\ServiceNotFoundException;

class EmbedViewComponent extends Component
{
    protected ServiceContract $service;
    protected Url $url;
    protected ?Ratio $aspectRatio;
    protected ?string $label;

    public function __construct(string $url, string $aspectRatio = null, string $label = null)
    {
        $this->url = new Url($url);
        $this->aspectRatio = $aspectRatio ? new Ratio($aspectRatio) : null;
        $this->label = $label;
    }

    public function render(): string
    {
        try {
            $this->service = ServiceFactory::getByUrl($this->url);
        } catch (ServiceNotFoundException $th) {
            $this->service = ServiceFactory::getFallback($this->url);
        }

        return $this->service
            ->setAspectRatio($this->aspectRatio)
            ->setLabel($this->label)
            ->cacheAndRender();
    }
}
