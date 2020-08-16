<?php

namespace BenSampo\Embed;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;

abstract class ServiceBase implements ServiceContract
{
    protected string $url;

    public function __construct(string $url)
    {
        $this->url = $url;    
    }

    abstract public static function detect(string $url): bool;
    
    public function render(): View
    {
        return view($this->fullyQualifiedViewName(), $this->viewData());
    }

    protected function viewName(): string
    {
        return $this->guessViewName();
    }

    private function fullyQualifiedViewName(): string
    {
        return 'embed::services.' . $this->viewName();
    }

    protected function viewData(): array
    {
        return [];
    }

    protected function guessViewName(): string
    {
        return Str::of(class_basename($this))->kebab()->lower();
    }
}
