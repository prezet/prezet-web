<x-prezet::template>
    @php
        seo()
        ->title($document->frontmatter->title)
        ->description($document->frontmatter->excerpt)
        ->url('https://prezet.com' . route('prezet.show', ['slug' => $document->slug], false))
        ->image(url($document->frontmatter->image))
        ->tag('robots', str_contains(request()->path(), 'v0.x') ? 'none' : 'all');
    @endphp

    @push('jsonld')
        <script type="application/ld+json">{!! $linkedData !!}</script>
    @endpush

    {{-- Right Sidebar --}}
    <x-slot name="left">
        <x-prezet::sidebar :nav="$nav" />
    </x-slot>

    {{-- Main Content --}}
    <article>
        <header class="mb-9 space-y-1">
            <p class="font-display text-sm font-medium text-primary-500">
                {{ $document->category }}
            </p>
            <h1
                class="font-display text-4xl font-medium tracking-tight text-stone-900"
            >
                {{ $document->frontmatter->title }}
            </h1>
        </header>
        <div
            class="prose-headings:font-display prose prose-stone max-w-none prose-a:border-b prose-a:border-dashed prose-a:border-black/30 prose-a:font-semibold prose-a:no-underline hover:prose-a:border-solid prose-img:rounded"
        >
            {!! $body !!}
        </div>
    </article>

    {{-- Right Sidebar --}}
    <x-slot name="right">
        <div
            class="hidden xl:sticky xl:top-[4.75rem] xl:-mr-6 xl:block xl:h-[calc(100vh-4.75rem)] xl:flex-none xl:overflow-y-auto xl:py-16 xl:pr-6"
        >
            <nav aria-labelledby="on-this-page-title" class="w-56">
                <p
                    id="on-this-page-title"
                    class="font-display text-sm font-medium text-stone-900"
                >
                    On this page
                </p>
                <ol role="list" class="mt-4 space-y-3 text-sm">
                    @foreach ($headings as $h2)
                        <li>
                            <a
                                href="#{{ $h2['id'] }}"
                                :class="{'text-primary-500 hover:text-primary-500': activeHeading === '#{{ $h2['title'] }}'}"
                                x-on:click.prevent="scrollToHeading('{{ $h2['id'] }}')"
                                class="transition-colors"
                            >
                                {{ $h2['title'] }}
                            </a>

                            @if ($h2['children'])
                                <ol
                                    role="list"
                                    class="mt-2 space-y-3 border-l pl-5"
                                >
                                    @foreach ($h2['children'] as $h3)
                                        <li>
                                            <a
                                                href="#{{ $h3['id'] }}"
                                                :class="{'text-primary-500 hover:text-primary-500': activeHeading === '#{{ $h3['title'] }}'}"
                                                x-on:click.prevent="scrollToHeading('{{ $h3['id'] }}')"
                                                class="transition-colors"
                                            >
                                                {{ $h3['title'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ol>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
        </div>
    </x-slot>
</x-prezet::template>
