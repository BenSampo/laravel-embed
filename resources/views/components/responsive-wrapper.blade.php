<style>
    .laravel-embed__responsive-wrapper { position: relative; height: 0; overflow: hidden; max-width: 100%; } 
    .laravel-embed__responsive-wrapper iframe, .laravel-embed__responsive-wrapper object, .laravel-embed__responsive-wrapper embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
</style>

<div class="laravel-embed__responsive-wrapper" style="padding-bottom: {{ $aspectRatio->asPercentage() }}%">
    {{ $slot }}
</div>