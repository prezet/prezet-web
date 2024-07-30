@php
    /* @var \BenBjurstrom\Prezet\Data\FrontmatterData $article */
@endphp

<x-prezet::template>
    @seo([
        'title' => 'Prezet: Markdown Blogging for Laravel',
        'description' =>
            'Transform your markdown files into SEO-friendly blogs, articles, and documentation!',
        'url' => route('prezet.index'),
        'image' => 'ogimage.png',
    ])

    <x-slot:hero>
        <div
            class="overflow-hidden bg-stone-900"
        >
            <div class="py-16 sm:px-2 lg:relative lg:px-0 lg:py-20">
                <div
                    class="mx-auto grid max-w-2xl grid-cols-1 items-center gap-x-8 gap-y-16 px-4 lg:max-w-6xl lg:grid-cols-2 lg:px-8 xl:gap-x-16 xl:px-12"
                >
                    <div class="relative z-10 md:text-center lg:text-left">
                        <div class="relative">
                            <p
                                class="font-display inline bg-gradient-to-r from-red-200 via-orange-400 to-red-200 bg-clip-text text-5xl tracking-tight text-transparent"
                            >
                                Markdown Blogging for Laravel
                            </p>
                            <p class="mt-3 text-2xl tracking-tight text-stone-400">
                                Transform your markdown files into SEO-friendly blogs, articles, and documentation!
                            </p>
                            <div
                                class="mt-8 flex gap-4 md:justify-center lg:justify-start"
                            >
                                <a
                                    class="rounded-full bg-orange-600 px-4 py-2 text-sm font-semibold text-stone-900 hover:bg-orange-500 focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-300/50 active:bg-orange-500"
                                    href="{{route('prezet.show', 'installation')}}"
                                >
                                    Get started
                                </a>
                                <a
                                    class="rounded-full bg-stone-800 px-4 py-2 text-sm font-medium text-white hover:bg-stone-700 focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white/50 active:text-stone-400"
                                    href="https://github.com/benbjurstrom/prezet"
                                    target="_blank"
                                >
                                    View on GitHub
                                </a>
                            </div>
                            <div class="flex mt-6">
                                <a href="https://www.producthunt.com/posts/prezet?embed=true&utm_source=badge-featured&utm_medium=badge&utm_souce=badge-prezet" target="_blank"><img src="https://api.producthunt.com/widgets/embed-image/v1/featured.svg?post_id=475024&theme=dark" alt="Prezet - Markdown&#0032;Blogging&#0032;for&#0032;the&#0032;Laravel&#0032;PHP&#0032;Framework | Product Hunt" style="width: 250px; height: 54px;" width="250" height="54" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="relative lg:static xl:pl-10">
                        <div
                            class="absolute inset-x-[-50vw] -bottom-48 -top-32 [mask-image:linear-gradient(transparent,white,white)] lg:-bottom-32 lg:-top-32 lg:left-[calc(50%+14rem)] lg:right-0 lg:[mask-image:none]"
                        >
                            <svg
                                aria-hidden="true"
                                viewBox="0 0 668 1069"
                                width="668"
                                height="1069"
                                fill="none"
                                class="absolute left-1/2 top-1/2 -transtone-x-1/2 -transtone-y-1/2 lg:left-0 lg:transtone-x-0 lg:transtone-y-[-60%]"
                            >
                                <defs>
                                    <clipPath id=":Rqja:-clip-path">
                                        <path
                                            fill="#fff"
                                            transform="rotate(-180 334 534.4)"
                                            d="M0 0h668v1068.8H0z"
                                        ></path>
                                    </clipPath>
                                </defs>
                                <g
                                    opacity=".4"
                                    clip-path="url(#:Rqja:-clip-path)"
                                    stroke-width="4"
                                >
                                    <path
                                        opacity=".3"
                                        d="M584.5 770.4v-474M484.5 770.4v-474M384.5 770.4v-474M283.5 769.4v-474M183.5 768.4v-474M83.5 767.4v-474"
                                        stroke="#334155"
                                    ></path>
                                    <path
                                        d="M83.5 221.275v6.587a50.1 50.1 0 0 0 22.309 41.686l55.581 37.054a50.102 50.102 0 0 1 22.309 41.686v6.587M83.5 716.012v6.588a50.099 50.099 0 0 0 22.309 41.685l55.581 37.054a50.102 50.102 0 0 1 22.309 41.686v6.587M183.7 584.5v6.587a50.1 50.1 0 0 0 22.31 41.686l55.581 37.054a50.097 50.097 0 0 1 22.309 41.685v6.588M384.101 277.637v6.588a50.1 50.1 0 0 0 22.309 41.685l55.581 37.054a50.1 50.1 0 0 1 22.31 41.686v6.587M384.1 770.288v6.587a50.1 50.1 0 0 1-22.309 41.686l-55.581 37.054A50.099 50.099 0 0 0 283.9 897.3v6.588"
                                        stroke="#334155"
                                    ></path>
                                    <path
                                        d="M384.1 770.288v6.587a50.1 50.1 0 0 1-22.309 41.686l-55.581 37.054A50.099 50.099 0 0 0 283.9 897.3v6.588M484.3 594.937v6.587a50.1 50.1 0 0 1-22.31 41.686l-55.581 37.054A50.1 50.1 0 0 0 384.1 721.95v6.587M484.3 872.575v6.587a50.1 50.1 0 0 1-22.31 41.686l-55.581 37.054a50.098 50.098 0 0 0-22.309 41.686v6.582M584.501 663.824v39.988a50.099 50.099 0 0 1-22.31 41.685l-55.581 37.054a50.102 50.102 0 0 0-22.309 41.686v6.587M283.899 945.637v6.588a50.1 50.1 0 0 1-22.309 41.685l-55.581 37.05a50.12 50.12 0 0 0-22.31 41.69v6.59M384.1 277.637c0 19.946 12.763 37.655 31.686 43.962l137.028 45.676c18.923 6.308 31.686 24.016 31.686 43.962M183.7 463.425v30.69c0 21.564 13.799 40.709 34.257 47.529l134.457 44.819c18.922 6.307 31.686 24.016 31.686 43.962M83.5 102.288c0 19.515 13.554 36.412 32.604 40.645l235.391 52.309c19.05 4.234 32.605 21.13 32.605 40.646M83.5 463.425v-58.45M183.699 542.75V396.625M283.9 1068.8V945.637M83.5 363.225v-141.95M83.5 179.524v-77.237M83.5 60.537V0M384.1 630.425V277.637M484.301 830.824V594.937M584.5 1068.8V663.825M484.301 555.275V452.988M584.5 622.075V452.988M384.1 728.537v-56.362M384.1 1068.8v-20.88M384.1 1006.17V770.287M283.9 903.888V759.85M183.699 1066.71V891.362M83.5 1068.8V716.012M83.5 674.263V505.175"
                                        stroke="#334155"
                                    ></path>
                                    <circle
                                        cx="83.5"
                                        cy="384.1"
                                        r="10.438"
                                        transform="rotate(-180 83.5 384.1)"
                                        fill="#1E293B"
                                        stroke="#334155"
                                    ></circle>
                                    <circle
                                        cx="83.5"
                                        cy="200.399"
                                        r="10.438"
                                        transform="rotate(-180 83.5 200.399)"
                                        stroke="#334155"
                                    ></circle>
                                    <circle
                                        cx="83.5"
                                        cy="81.412"
                                        r="10.438"
                                        transform="rotate(-180 83.5 81.412)"
                                        stroke="#334155"
                                    ></circle>
                                    <circle
                                        cx="183.699"
                                        cy="375.75"
                                        r="10.438"
                                        transform="rotate(-180 183.699 375.75)"
                                        fill="#1E293B"
                                        stroke="#334155"
                                    ></circle>
                                    <circle
                                        cx="183.699"
                                        cy="563.625"
                                        r="10.438"
                                        transform="rotate(-180 183.699 563.625)"
                                        fill="#1E293B"
                                        stroke="#334155"
                                    ></circle>
                                    <circle
                                        cx="384.1"
                                        cy="651.3"
                                        r="10.438"
                                        transform="rotate(-180 384.1 651.3)"
                                        fill="#1E293B"
                                        stroke="#334155"
                                    ></circle>
                                    <circle
                                        cx="484.301"
                                        cy="574.062"
                                        r="10.438"
                                        transform="rotate(-180 484.301 574.062)"
                                        fill="#0EA5E9"
                                        fill-opacity=".42"
                                        stroke="#0EA5E9"
                                    ></circle>
                                    <circle
                                        cx="384.1"
                                        cy="749.412"
                                        r="10.438"
                                        transform="rotate(-180 384.1 749.412)"
                                        fill="#1E293B"
                                        stroke="#334155"
                                    ></circle>
                                    <circle
                                        cx="384.1"
                                        cy="1027.05"
                                        r="10.438"
                                        transform="rotate(-180 384.1 1027.05)"
                                        stroke="#334155"
                                    ></circle>
                                    <circle
                                        cx="283.9"
                                        cy="924.763"
                                        r="10.438"
                                        transform="rotate(-180 283.9 924.763)"
                                        stroke="#334155"
                                    ></circle>
                                    <circle
                                        cx="183.699"
                                        cy="870.487"
                                        r="10.438"
                                        transform="rotate(-180 183.699 870.487)"
                                        stroke="#334155"
                                    ></circle>
                                    <circle
                                        cx="283.9"
                                        cy="738.975"
                                        r="10.438"
                                        transform="rotate(-180 283.9 738.975)"
                                        fill="#1E293B"
                                        stroke="#334155"
                                    ></circle>
                                    <circle
                                        cx="83.5"
                                        cy="695.138"
                                        r="10.438"
                                        transform="rotate(-180 83.5 695.138)"
                                        fill="#1E293B"
                                        stroke="#334155"
                                    ></circle>
                                    <circle
                                        cx="83.5"
                                        cy="484.3"
                                        r="10.438"
                                        transform="rotate(-180 83.5 484.3)"
                                        fill="#0EA5E9"
                                        fill-opacity=".42"
                                        stroke="#0EA5E9"
                                    ></circle>
                                    <circle
                                        cx="484.301"
                                        cy="432.112"
                                        r="10.438"
                                        transform="rotate(-180 484.301 432.112)"
                                        fill="#1E293B"
                                        stroke="#334155"
                                    ></circle>
                                    <circle
                                        cx="584.5"
                                        cy="432.112"
                                        r="10.438"
                                        transform="rotate(-180 584.5 432.112)"
                                        fill="#1E293B"
                                        stroke="#334155"
                                    ></circle>
                                    <circle
                                        cx="584.5"
                                        cy="642.95"
                                        r="10.438"
                                        transform="rotate(-180 584.5 642.95)"
                                        fill="#1E293B"
                                        stroke="#334155"
                                    ></circle>
                                    <circle
                                        cx="484.301"
                                        cy="851.699"
                                        r="10.438"
                                        transform="rotate(-180 484.301 851.699)"
                                        stroke="#334155"
                                    ></circle>
                                    <circle
                                        cx="384.1"
                                        cy="256.763"
                                        r="10.438"
                                        transform="rotate(-180 384.1 256.763)"
                                        stroke="#334155"
                                    ></circle>
                                </g>
                            </svg>
                        </div>
                        <div class="relative">
                            <div
                                class="absolute inset-0 rounded-2xl bg-gradient-to-tr from-orange-300 via-orange-300/70 to-amber-300 opacity-10 blur-lg"
                            ></div>
                            <div
                                class="absolute inset-0 rounded-2xl bg-gradient-to-tr from-orange-300 via-orange-300/70 to-amber-300 opacity-10"
                            ></div>
                            <div
                                class="relative rounded-2xl bg-[#0A101F]/80 ring-1 ring-white/10 backdrop-blur"
                            >
                                <div
                                    class="absolute -top-px left-20 right-11 h-px bg-gradient-to-r from-orange-300/0 via-orange-300/70 to-orange-300/0"
                                ></div>
                                <div
                                    class="absolute -bottom-px left-11 right-20 h-px bg-gradient-to-r from-amber-400/0 via-amber-400 to-amber-400/0"
                                ></div>
                                <div class="pl-4 pt-4">
                                    <svg
                                        aria-hidden="true"
                                        viewBox="0 0 42 10"
                                        fill="none"
                                        class="h-2.5 w-auto stroke-stone-500/30"
                                    >
                                        <circle cx="5" cy="5" r="4.5"></circle>
                                        <circle cx="21" cy="5" r="4.5"></circle>
                                        <circle cx="37" cy="5" r="4.5"></circle>
                                    </svg>
                                    <div class="mt-4 flex space-x-2 text-xs">
                                        <div
                                            class="flex h-6 rounded-full bg-gradient-to-r from-orange-400/30 via-orange-400 to-orange-400/30 p-px font-medium text-orange-300"
                                        >
                                            <div
                                                class="flex items-center rounded-full bg-stone-800 px-2.5"
                                            >
                                                blog-post.md
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-6 flex items-start px-1 text-sm">
                                        <div
                                            aria-hidden="true"
                                            class="select-none border-r border-stone-300/5 pr-4 font-mono text-stone-600"
                                        >
                                            01
                                            <br />
                                            02
                                            <br />
                                            03
                                            <br />
                                            04
                                            <br />
                                            05
                                            <br />
                                            06
                                            <br />
                                            07
                                            <br />
                                            08
                                            <br />
                                            09
                                        </div>
                                        <pre
                                            class="prism-code language-javascript flex overflow-x-auto pb-6 text-stone-300"
                                        ><code class="px-4">---
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

        <div class="flex justify-center mt-12">
            <div class="w-[600px]">
                <x-prezet::youtube videoid="CkfCnjflA3Q" title="Prezet: Markdown Blogging for Laravel" date="2024-07-09" description="Here's a quick demo showing how easy it is to get a markdown blog up and running with Prezet." />
            </div>
        </div>

        {{-- features --}}
        <div class="max-w-6xl mx-auto px-4 lg:px-8 xl:px-12 py-12 lg:py-24">
            <div class="text-center md:text-left mb-12">
                <h2 class="text-3xl font-bold">Features</h2>
                <p class="text-stone-600">Prezet provides a comprehensive toolkit for production-ready blogging</p>
            </div>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="text-center md:text-left">
                    <div class="flex justify-center md:justify-start mb-4">
                        <div class="bg-red-100 rounded-full p-3">
                            <x-lucide-heading-2 class="w-6 h-6 text-red-500" />
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold">Markdown Powered</h3>
                    <p class="text-stone-600">
                        Transform markdown files into SEO-friendly content, no database required!
                    </p>
                    <a href="{{ route('prezet.show', 'features/markdown') }}" class="text-red-500 hover:underline">Learn more</a>
                </div>
                <div class="text-center md:text-left">
                    <div class="flex justify-center md:justify-start mb-4">
                        <div class="bg-green-100 rounded-full p-3">
                            <x-lucide-blocks class="w-6 h-6 text-green-500" />
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold">Blade Components</h3>
                    <p class="text-stone-600">
                        Add dynamic elements to static content with inline blade components.
                    </p>
                    <a href="{{ route('prezet.show', 'features/blade') }}" class="text-green-500 hover:underline">Learn more</a>
                </div>
                <div class="text-center md:text-left">
                    <div class="flex justify-center md:justify-start mb-4">
                        <div class="bg-blue-100 rounded-full p-3">
                            <x-lucide-image class="w-6 h-6 text-blue-500" />
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold">Optimized Images</h3>
                    <p class="text-stone-600">
                        Automatic WebP conversion and generated srcsets.
                    </p>
                    <a href="{{ route('prezet.show', 'features/images') }}" class="text-blue-500 hover:underline">Learn more</a>
                </div>
                <div class="text-center md:text-left">
                    <div class="flex justify-center md:justify-start mb-4">
                        <div class="bg-purple-100 rounded-full p-3">
                            <x-lucide-braces class="w-6 h-6 text-purple-500" />
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold">Typed Front Matter</h3>
                    <p class="text-stone-600">
                        Front matter is cast to DTOs to ensure data consistency across your content.
                    </p>
                    <a href="{{ route('prezet.show', 'features/frontmatter') }}" class="text-purple-500 hover:underline">Learn more</a>
                </div>
                <div class="text-center md:text-left">
                    <div class="flex justify-center md:justify-start mb-4">
                        <div class="bg-indigo-100 rounded-full p-3">
                            <x-lucide-tags class="w-6 h-6 text-indigo-500" />
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold">SEO Tags</h3>
                    <p class="text-stone-600">
                        Auto-generate meta tags from front matter data to boost search engine discoverability.
                    </p>
                    <a href="{{ route('prezet.show', 'features/seo') }}" class="text-indigo-500 hover:underline">Learn more</a>
                </div>
                <div class="text-center md:text-left">
                    <div class="flex justify-center md:justify-start mb-4">
                        <div class="bg-pink-100 rounded-full p-3">
                            <x-lucide-cpu class="w-6 h-6 text-pink-500" />
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold">Ogimage Generation</h3>
                    <p class="text-stone-600">
                        Create custom Open Graph images to enhance social media sharing.
                    </p>
                    <a href="{{ route('prezet.show', 'features/ogimage') }}" class="text-pink-500 hover:underline">Learn more</a>
                </div>
            </div>
        </div>

        {{-- /features --}}
    </x-slot:hero>
</x-prezet::template>
