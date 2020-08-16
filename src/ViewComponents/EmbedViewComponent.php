<?php

namespace BenSampo\Embed\ViewComponents;

use BenSampo\Embed\ServiceFactory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmbedViewComponent extends Component
{
    public string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function render(): View
    {
        return ServiceFactory::getByUrl($this->url)->render();
    }
}
