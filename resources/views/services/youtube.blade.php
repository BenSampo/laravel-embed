<x-embed-responsive-wrapper :aspect-ratio="$aspectRatio">
    <iframe
        aria-label="foo {{ $label }}"
        src="https://www.youtube-nocookie.com/embed/{{ $videoId }}{{ $autoplay }}"
        frameborder="0"
        allow="accelerometer; encrypted-media; gyroscope; picture-in-picture; autoplay;"
        allowfullscreen
    ></iframe>
</x-embed-responsive-wrapper>
