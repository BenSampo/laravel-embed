<?php

namespace BenSampo\Embed;

use BenSampo\Embed\ValueObjects\Ratio;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;

abstract class ServiceBase implements ServiceContract
{
    protected string $url;
    protected ?Ratio $aspectRatio;

    public function __construct(string $url)
    {
        $this->url = $url;    
    }

    abstract public static function detect(string $url): bool;
    
    public function view(): View
    {
        return view($this->fullyQualifiedViewName(), array_merge($this->viewData(), [
            'aspectRatio' => $this->aspectRatio ?? $this->defaultAspectRatio(),
        ]));
    }

    public function setAspectRatio(?Ratio $aspectRatio): ServiceContract
    {
        $this->aspectRatio = $aspectRatio;

        return $this;
    }

    protected function viewName(): string
    {
        return $this->guessViewName();
    }

    protected function defaultAspectRatio(): Ratio
    {
        return new Ratio('16:9');
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
