<div class="aspect-video" {{ $attributes }}>
    <lite-youtube
        videoid="{{ $attributes['videoid'] }}"
        style="background-image: url('https://i.ytimg.com/vi/{{ $attributes['videoid'] }}/hqdefault.jpg');"
        title="{{ $attributes['title'] }}"
    >
        <a href="https://youtube.com/watch?v={{ $attributes['videoid'] }}" class="lty-playbtn" title="Play Video">
            <span class="lyt-visually-hidden">Play Video: {{ $attributes['title'] }}</span>
        </a>
    </lite-youtube>

    <script
        type="application/ld+json"
    >
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'VideoObject',
            'url' => 'https://www.youtube.com/watch?v=' . $attributes['title'],
            'name' => $attributes['title'],
            'identifier' => $attributes['videoid'],
            'description' => $attributes['description'],
            'thumbnailUrl' => 'https://i.ytimg.com/vi/' . $attributes['videoid'] . '/maxresdefault.jpg',
            'uploadDate' => $attributes['date'],
            'duration' => $attributes['duration'],
            'embedUrl' => 'https://www.youtube.com/embed/' . $attributes['videoid'],
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>
</div>
