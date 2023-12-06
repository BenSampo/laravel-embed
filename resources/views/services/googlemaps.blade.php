<x-embed-responsive-wrapper :aspect-ratio="$aspectRatio">
    <iframe
            aria-label="{{ $label }}"
            src="{{ $iframeUrl }}"
            frameborder="0"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
    ></iframe>
</x-embed-responsive-wrapper>
