<?php

namespace BenSampo\Embed\ViewComponents;

use Illuminate\View\Component;
use BenSampo\Embed\ServiceFactory;
use Illuminate\Support\Facades\Cache;
use BenSampo\Embed\ValueObjects\Ratio;

class EmbedViewComponent extends Component
{
    public string $url;
    public ?Ratio $aspectRatio;

    public function __construct(string $url, string $aspectRatio = null)
    {
        $this->url = $url;
        $this->aspectRatio = $aspectRatio ? new Ratio($aspectRatio) : null;
    }

    public function render(): string
    {
        return Cache::rememberForever($this->url, function () {
            return ServiceFactory::getByUrl($this->url)
                ->setAspectRatio($this->aspectRatio)
                ->view()
                ->render();
        });
    }
}
