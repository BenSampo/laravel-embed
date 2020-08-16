<?php

namespace BenSampo\Embed\ViewComponents;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ResponsiveWrapperViewComponent extends Component
{
    public function render(): View
    {
        return view('embed::components.responsive-wrapper');
    }
}
