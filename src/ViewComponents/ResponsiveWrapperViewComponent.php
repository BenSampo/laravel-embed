<?php

namespace BenSampo\Embed\ViewComponents;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use BenSampo\Embed\ValueObjects\Ratio;

class ResponsiveWrapperViewComponent extends Component
{
    public Ratio $aspectRatio;

    public function __construct(Ratio $aspectRatio)
    {
        $this->aspectRatio = $aspectRatio;
    }

    public function render(): View
    {
        return view('embed::components.responsive-wrapper');
    }
}
