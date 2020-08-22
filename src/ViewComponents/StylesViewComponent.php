<?php

namespace BenSampo\Embed\ViewComponents;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class StylesViewComponent extends Component
{
    public function render(): View
    {
        return view('embed::components.styles');
    }
}
