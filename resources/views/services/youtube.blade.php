<x-embed-responsive-wrapper :aspect-ratio="$aspectRatio">
    <iframe
        aria-label="foo {{ $label }}"
        src="https://www.youtube-nocookie.com/embed/{{ $videoId }}"
        frameborder="0"
        allow="accelerometer; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen
    ></iframe>
</x-embed-responsive-wrapper>
