<?php

namespace BenSampo\Embed;

use Illuminate\Contracts\View\View;
use BenSampo\Embed\ValueObjects\Ratio;
use BenSampo\Embed\ValueObjects\Url;

interface ServiceContract
{
    public static function detect(Url $url): bool;
    public function view(): View;
    public function cacheAndRender(): string;
    public function setAspectRatio(?Ratio $aspectRatio): ServiceContract;
}