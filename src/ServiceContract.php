<?php

namespace BenSampo\Embed;

use Illuminate\Contracts\View\View;
use BenSampo\Embed\ValueObjects\Ratio;

interface ServiceContract
{
    public static function detect(string $url): bool;
    public function view(): View;
    public function setAspectRatio(?Ratio $aspectRatio): ServiceContract;
}