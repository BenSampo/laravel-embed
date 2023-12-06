<x-embed-responsive-wrapper :aspect-ratio="$aspectRatio">
    <iframe
            aria-label="{{ $label }}"
            src="{{ $iframeUrl }}"
            frameborder="0"
            allow="autoplay; fullscreen"
            allowfullscreen
    ></iframe>
</x-embed-responsive-wrapper>
