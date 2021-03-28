# Laravel Embed

<p align="center"><img src="https://github.com/BenSampo/laravel-embed/raw/master/branding/github-open-graph-image.png?sanitize=true" alt="Laravel Embed" style="margin-bottom: 20px"></p>

<p align="center" style="margin-bottom: 20px">
Effortless responsive embeds for videos, slideshows and more.<br>
Created by <a href="https://sampo.co.uk">Ben Sampson</a>
</p>

<p align="center">
<a href="https://packagist.org/packages/bensampo/laravel-embed"><img src="https://img.shields.io/packagist/v/bensampo/laravel-embed.svg?style=flat-square&label=stable" alt="Packagist Stable Version"></a>
<a href="https://packagist.org/packages/bensampo/laravel-embed"><img src="https://img.shields.io/packagist/dt/bensampo/laravel-embed.svg?style=flat-square" alt="Packagist downloads"></a>
<a href="LICENSE.md"><img src="https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square" alt="MIT Software License"></a>
</p>

## Requirements

- Laravel `7.25` or newer
- PHP `7.4.0` or newer

## Installation

### 1. Composer

```bash
composer require bensampo/laravel-embed
```

### 2. Include styles

Somewhere inside the `<head>` element of the document, include:

```html
<x-embed-styles />
```

If you'd prefer to include the styles in your own CSS file, you may copy the contents of [`styles.blade.php`](https://github.com/BenSampo/laravel-embed/blob/master/resources/views/components/styles.blade.php).

### 3. Publish views (optional)

If you'd like to edit any of the views you may publish them:

```bash
php artisan vendor:publish --provider="BenSampo\Embed\EmbedServiceProvider"
```

Once published they can be found in `/resources/views/vendor/embed/`.

## Usage

Simply include the following blade component in your view making sure to pass the `url` attribute.

The `url` should be the public URL for the page you're trying to embed.

```html
<x-embed url="https://www.youtube.com/watch?v=oHg5SJYRHA0" />
```

### Setting the aspect ratio

By default most embedded services are shown at a ratio of `16:9`. Some services may override this if they have a more appropriate default. However, you can always change this by passing in a ratio to the `aspect-ratio` attribute.

```html
<x-embed url="https://www.youtube.com/watch?v=oHg5SJYRHA0" aspect-ratio="4:3" />
```

The aspect ratio is maintained at different viewport sizes.

### Fallback

If no service exists to handle the URL a fallback view is rendered. You can customize this by publishing the views and editing `/resources/views/vendor/embed/services/fallback.blade.php`.

### Validation

A validation rule can be used to check for a supported service in a given URL.

```php
use BenSampo\Embed\Rules\EmbeddableUrl;

public function store(Request $request)
{
    $this->validate($request, [
        'url' => ['required', new EmbeddableUrl],
    ]);
}
```

You may specify a list of allowed services using the `allowedServices` method.

```php
use BenSampo\Embed\Services\Vimeo;
use BenSampo\Embed\Services\YouTube;
use BenSampo\Embed\Rules\EmbeddableUrl;

public function store(Request $request)
{
    $this->validate($request, [
        'url' => [
            'required',
            (new EmbeddableUrl)->allowedServices([
                YouTube::class,
                Vimeo::class
            ])
        ],
    ]);
}
```

## Embed Services

Laravel embed supports multiple popular embed services such as YouTube, Vimeo and Slideshare.

[See the full list &rarr;](https://github.com/BenSampo/laravel-embed/tree/master/src/Services)

Please submit an issue (or better yet a PR!) if the service you'd like to embed is not listed.
