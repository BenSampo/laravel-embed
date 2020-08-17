<?php

namespace BenSampo\Embed\ViewComponents;

use Illuminate\View\Component;
use BenSampo\Embed\ServiceFactory;
use Illuminate\Support\Facades\Cache;

class EmbedViewComponent extends Component
{
    public string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function render(): string
    {
        return Cache::rememberForever($this->url, function () {
            return ServiceFactory::getByUrl($this->url)->render()->render();
        });
    }
}
