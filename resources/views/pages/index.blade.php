<x-prezet.template :document="$document" :nav="$nav" :headings="$headings">
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

    <section class="mt-16 min-w-0 md:mr-8 xl:mr-0">

        <div class="relative">

            <div class="overflow-hidden">
                <div class="sm:px-2 lg:relative lg:px-0">
                    <div class="space-y-12">
                        <div class="relative z-10">
                            <div class="relative">
                                <h1 class="font-display font-semibold inline bg-linear-to-r from-red-600 via-orange-500 to-red-600 bg-clip-text text-5xl tracking-tight text-transparent dark:from-red-200 dark:via-orange-400 dark:to-red-200">
                                    Markdown Blogging for Laravel
                                </h1>
                                <h2 class="mt-3 text-2xl tracking-tight text-gray-700 dark:text-stone-400">
                                    Transform your markdown files into SEO-friendly blogs, articles, and documentation!
                                </h2>
                            </div>
                        </div>
                        <div class="relative lg:static">
                            <div class="relative">
                                <div class="absolute inset-0 rounded-2xl bg-linear-to-tr from-orange-400 via-orange-400/70 to-amber-400 opacity-25 blur-lg dark:from-orange-300 dark:via-orange-300/70 dark:to-amber-300 dark:opacity-10"></div>
                                <div class="absolute inset-0 rounded-2xl bg-linear-to-tr from-orange-400 via-orange-400/70 to-amber-400 opacity-20 dark:from-orange-300 dark:via-orange-300/70 dark:to-amber-300 dark:opacity-10"></div>
                                <div class="relative rounded-2xl bg-[#0A101F] dark:bg-[#0A101F]/80 ring-1 ring-slate-200/20 dark:ring-white/10 backdrop-blur-sm">
                                    <div class="absolute -top-px left-20 right-11 h-px bg-linear-to-r from-orange-400/0 via-orange-500/60 to-orange-400/0 dark:from-orange-300/0 dark:via-orange-300/70 dark:to-orange-300/0"></div>
                                    <div class="absolute -bottom-px left-11 right-20 h-px bg-linear-to-r from-amber-500/0 via-amber-500/80 to-amber-500/0 dark:from-amber-400/0 dark:via-amber-400 dark:to-amber-400/0"></div>
                                    <div class="pl-4 pt-4">
                                        <svg aria-hidden="true" viewBox="0 0 42 10" fill="none" class="h-2.5 w-auto stroke-stone-500/30">
                                            <circle cx="5" cy="5" r="4.5"></circle>
                                            <circle cx="21" cy="5" r="4.5"></circle>
                                            <circle cx="37" cy="5" r="4.5"></circle>
                                        </svg>
                                        <div class="mt-4 flex space-x-2 text-xs">
                                            <div class="flex h-6 rounded-full bg-linear-to-r from-orange-400/30 via-orange-400 to-orange-400/30 p-px font-medium text-orange-300">
                                                <div class="flex items-center rounded-full bg-stone-800 px-2.5">
                                                    blog-post.md
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-6 flex items-start px-1 text-sm">
                                            <div aria-hidden="true" class="select-none border-r border-stone-300/5 pr-4 font-mono text-stone-600">
                                                01
                                                <br>
                                                02
                                                <br>
                                                03
                                                <br>
                                                04
                                                <br>
                                                05
                                                <br>
                                                06
                                                <br>
                                                07
                                                <br>
                                                08
                                                <br>
                                                09
                                            </div>
                                            <pre class="prism-code language-javascript flex overflow-x-auto pb-6 text-stone-300"><code class="px-4">---
title: My Blog Post
excerpt: This is a blog post...
slug: blog-post
date: 2024-06-28
author: Ben Bjurstrom
---

This is a blog post written in markdown...
                                            </code></pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <article
            class="prose prose-gray dark:prose-invert relative mt-8 mb-14 !max-w-none"
        >
            {!! $body !!}
        </article>

        <x-prezet.footer />
    </section>

</x-prezet.template>
