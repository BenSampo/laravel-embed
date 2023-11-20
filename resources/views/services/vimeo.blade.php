<x-embed-responsive-wrapper :aspect-ratio="$aspectRatio">
    <iframe 
            aria-label="{{ $label }}"
            src="https://player.vimeo.com/video/{{ $videoId }}@if($videoHash)?h={{ $videoHash}}@endif"
            frameborder="0"
            allow="autoplay; fullscreen"
            allowfullscreen
    ></iframe>
</x-embed-responsive-wrapper>
