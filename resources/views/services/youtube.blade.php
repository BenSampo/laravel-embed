@php
    $embedUrl = $videoId
        ? "https://www.youtube-nocookie.com/embed/{$videoId}?start={$start}" . ($playlistId ? "&list={$playlistId}" : '')
        : "https://www.youtube-nocookie.com/embed/videoseries?list={$playlistId}";
@endphp
<x-embed-responsive-wrapper :aspect-ratio="$aspectRatio">
    <iframe
        aria-label="{{ $label }}"
        src="{{ $embedUrl }}"
        frameborder="0"
        allow="accelerometer; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen
    ></iframe>
</x-embed-responsive-wrapper>
