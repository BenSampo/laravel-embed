<?php

namespace BenSampo\Embed;

use BenSampo\Embed\ValueObjects\Ratio;
use BenSampo\Embed\ValueObjects\Url;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

abstract class ServiceBase implements ServiceContract
{
    protected Url $url;

    protected ?Ratio $aspectRatio;

    protected ?string $label;

    public function __construct(Url $url)
    {
        $this->url = $url;
    }

    abstract public static function detect(Url $url): bool;

    public function cacheAndRender(): string
    {
        return Cache::rememberForever($this->cacheKey(), function () {
            return $this->view()->render();
        });
    }

    public function view(): View
    {
        return view($this->fullyQualifiedViewName(), array_merge($this->viewData(), [
            'aspectRatio' => $this->aspectRatio(),
            'label'       => $this->label(),
        ]));
    }

    public function setAspectRatio(?Ratio $aspectRatio): ServiceContract
    {
        $this->aspectRatio = $aspectRatio;

        return $this;
    }

    public function setLabel(?string $label): ServiceContract
    {
        $this->label = $label ?? $this->defaultLabel();

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

    protected function label(): string
    {
        return $this->label ?? $this->defaultLabel();
    }

    protected function defaultAspectRatio(): Ratio
    {
        return new Ratio('16:9');
    }

    protected function defaultLabel(): string
    {
        return __('An embedded video');
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
        $url         = (string) $this->url;
        $label       = $this->label();
        $aspectRatio = $this->aspectRatio()->width . ':' . $this->aspectRatio()->height;

        return $serviceName . '_' . $url . '_' . $aspectRatio . '_' . $label;
    }
}
