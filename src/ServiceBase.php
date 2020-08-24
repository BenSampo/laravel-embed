<?php

namespace BenSampo\Embed;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use BenSampo\Embed\ValueObjects\Url;
use Illuminate\Support\Facades\Cache;
use BenSampo\Embed\ValueObjects\Ratio;

abstract class ServiceBase implements ServiceContract
{
    protected Url $url;
    protected ?Ratio $aspectRatio;

    public function __construct(Url $url)
    {
        $this->url = $url;
    }

    abstract public static function detect(Url $url): bool;

    public function cacheAndRender(): string
    {
        return Cache::rememberForever($this->cacheKey(), function() {
            return $this->view()->render();
        });
    }
    
    public function view(): View
    {
        return view($this->fullyQualifiedViewName(), array_merge($this->viewData(), [
            'aspectRatio' => $this->aspectRatio(),
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

    protected function aspectRatio(): Ratio
    {
        return $this->aspectRatio ?? $this->defaultAspectRatio();
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

    protected function cacheKey(): string
    {
        $serviceName = class_basename(static::class);
        $url = (string) $this->url;
        $aspectRatio = $this->aspectRatio()->width . ':' . $this->aspectRatio()->height;

        return $serviceName . '_' . $url . '_' . $aspectRatio;
    }
}
