<?php

namespace BenSampo\Embed;

use Illuminate\Contracts\View\View;

interface ServiceContract
{
    public static function detect(string $url): bool;
    public function render(): View;
}