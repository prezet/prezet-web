<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://cdn.jsdelivr.net" />

        <x-prezet::seo />

        <link
            rel="icon"
            href="/favicon.ico"
            type="image/x-icon"
            sizes="16x16"
        />
        <link
            rel="icon"
            href="/favicon.svg"
            type="image/svg+xml"
            sizes="any"
        />
        <link rel="alternate" type="application/atom+xml" title="News" href="/feed">

        <!-- Scripts -->
        <!-- Zoomable Plugin (example version) -->
        <script defer src="https://unpkg.com/@benbjurstrom/alpinejs-zoomable@0.4.0/dist/cdn.min.js"></script>
        <script
            defer
            src="https://cdn.jsdelivr.net/npm/lite-youtube-embed@0.3.2/src/lite-yt-embed.min.js"
        ></script>
        <script
            defer
            src="https://unpkg.com/@alpinejs/ui@3.14.8/dist/cdn.min.js"
        ></script>
        <script
            defer
            src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.14.1/dist/cdn.min.js"
        ></script>
        <script
            defer
            src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"
        ></script>
        @vite(['resources/css/prezet.css'])
        @stack('jsonld')
    </head>
    <body class="dark:bg-background-dark font-sans antialiased">
        <div class="min-h-screen">
            <x-prezet.alpine>
                <div
                    class="relative text-gray-500 antialiased dark:text-gray-400"
                >

                    <x-prezet.alpine>
                        {{-- Alpine.js only. No layout markup added by this component --}}

                        {{-- Sticky header: takes up its own space (not fixed), and aligns with main container --}}
                        <header
                            class="bg-background-light/95 dark:bg-background-dark/95 supports-[backdrop-filter]:bg-background-light/75 dark:supports-[backdrop-filter]:bg-background-dark/75 sticky top-0 z-30 backdrop-blur"
                        >
                            <div class="max-w-8xl mx-auto px-4 xl:px-4">
                                <x-prezet.header :document="$document" />
                            </div>
                        </header>

                        <main class="max-w-8xl relative mx-auto px-4 xl:px-4">
                            {{-- Mobile Sidebar (now inside main, below header; header stays unblurred) --}}
                            <div
                                x-cloak
                                x-show="showSidebar"
                                x-trap.inert.noscroll="showSidebar"
                                class="absolute inset-0 z-40 flex h-full items-start overflow-hidden lg:hidden"
                                style="display: none"
                            >
                                {{-- Overlay: scoped to main only (does NOT cover sticky header) --}}
                                <div
                                    x-show="showSidebar"
                                    class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm"
                                    x-transition:enter="transition duration-300 ease-out"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition duration-200 ease-in"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    x-on:click="showSidebar = false"
                                ></div>

                                {{-- Drawer: slides in from left, beneath header --}}
                                <aside
                                    x-show="showSidebar"
                                    class="bg-background-light dark:bg-background-dark relative z-10 h-[100dvh] w-[85dvw] max-w-[22rem] min-w-[19rem] shadow-lg"
                                    x-transition:enter="transform transition duration-300 ease-out"
                                    x-transition:enter-start="-translate-x-full"
                                    x-transition:enter-end="translate-x-0"
                                    x-transition:leave="transform transition duration-200 ease-in"
                                    x-transition:leave-start="translate-x-0"
                                    x-transition:leave-end="-translate-x-full"
                                    x-on:click.outside="showSidebar = false"
                                    aria-label="Primary navigation"
                                >
                                    <div class="h-full overflow-y-auto px-4 pt-4 pb-12">
                                        <div class="relative lg:text-sm lg:leading-6">
                                            <x-prezet.sidebar-left-content :nav="$nav" />
                                        </div>
                                    </div>
                                </aside>
                            </div>

                            {{-- Responsive columns: 1 -> 2 (md/lg) -> 3 (xl) --}}
                            <div
                                class="grid grid-cols-1 gap-8 md:grid-cols-[18rem_minmax(0,1fr)] xl:grid-cols-[18rem_minmax(0,1fr)_19rem]"
                            >
                                {{-- Left Sidebar (desktop) --}}
                                <aside
                                    class="sticky top-36 hidden h-[calc(100vh-6rem)] w-[18rem] self-start md:block xl:w-[18rem]"
                                    aria-label="Primary navigation"
                                >
                                    <div class="h-full overflow-y-auto pr-0 md:pr-6 xl:pr-8">
                                        <div class="relative lg:text-sm lg:leading-6">
                                            <x-prezet.sidebar-left-content :nav="$nav" />
                                        </div>
                                    </div>
                                </aside>

                                {{-- Center Content --}}
                                {{ $slot }}

                                {{-- Right Sidebar (TOC) at xl+ --}}
                                <aside
                                    class="sticky top-36 hidden h-[calc(100vh-6rem)] self-start xl:flex"
                                    aria-label="On this page"
                                >
                                    <div
                                        class="z-10 box-border max-h-full w-[19rem] pl-10 xl:flex"
                                    >
                                        <nav
                                            class="-mt-10 w-[16.5rem] space-y-2 overflow-y-auto pt-10 pb-4 text-sm leading-6 text-gray-600"
                                        >
                                            <button
                                                class="flex cursor-pointer items-center space-x-2 font-medium text-gray-700 transition-colors hover:text-gray-900 dark:text-gray-300 dark:hover:text-gray-100"
                                                type="button"
                                                aria-label="On this page"
                                                @click="window.scrollTo({top: 0, behavior: 'smooth'})"
                                            >
                                                <svg
                                                    width="16"
                                                    height="16"
                                                    viewBox="0 0 16 16"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    class="h-3 w-3"
                                                >
                                                    <path
                                                        d="M2.444 12.667H13.556"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                    />
                                                    <path
                                                        d="M2.444 3.333H13.556"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                    />
                                                    <path
                                                        d="M2.444 8H7.333"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                    />
                                                </svg>
                                                <span>On this page</span>
                                            </button>

                                            <ul class="toc">
                                                @foreach ($headings as $h2)
                                                    <li
                                                        class="toc-item relative"
                                                        data-depth="0"
                                                    >
                                                        <a
                                                            href="#{{ $h2['id'] }}"
                                                            class="block py-1 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300"
                                                            :class="{'text-primary dark:text-primary-light border-primary dark:border-primary-light hover:border-primary dark:hover:border-primary-light font-medium': activeHeading === '{{ $h2['id'] }}'}"
                                                            x-on:click.prevent="scrollToHeading('{{ $h2['id'] }}')"
                                                        >
                                                            {{ $h2['title'] }}
                                                        </a>
                                                    </li>
                                                    @foreach ($h2['children'] as $h3)
                                                        <li class="toc-item relative">
                                                            <a
                                                                href="#{{ $h3['id'] }}"
                                                                class="group flex items-start py-1 pl-4 text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300"
                                                                :class="{'text-primary dark:text-primary-light': activeHeading === '{{ $h3['id'] }}'}"
                                                                x-on:click.prevent="scrollToHeading('{{ $h3['id'] }}')"
                                                            >
                                                                {{ $h3['title'] }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        </nav>
                                    </div>
                                </aside>
                            </div>
                        </main>

                        {{-- Search Modal - positioned at root level for full viewport overlay --}}
                        <div
                            x-cloak
                            x-show="searchOpen"
                            x-trap.inert.noscroll="searchOpen"
                            x-transition:enter="transition duration-300 ease-out"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition duration-200 ease-in"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            x-bind:aria-hidden="!searchOpen"
                            x-on:keydown.esc.prevent.stop="closeCommandPalette()"
                            class="z-90 fixed inset-0 overflow-y-auto overflow-x-hidden bg-zinc-900/75 p-4 backdrop-blur-xs will-change-auto md:py-8 lg:px-8 lg:py-16"
                            tabindex="-1"
                            role="dialog"
                            aria-modal="true"
                        >
                            {{-- Command Palette Container --}}
                            <div
                                x-cloak
                                x-show="searchOpen"
                                x-transition:enter="transition duration-300 ease-out"
                                x-transition:enter-start="-translate-y-32 opacity-0"
                                x-transition:enter-end="translate-y-0 opacity-100"
                                x-transition:leave="transition duration-150 ease-in"
                                x-transition:leave-start="translate-y-0 opacity-100"
                                x-transition:leave-end="translate-y-32 opacity-0"
                                x-on:click.outside="closeCommandPalette()"
                                class="mx-auto flex w-full max-w-lg flex-col rounded-xl shadow-xl will-change-auto dark:text-zinc-100 dark:shadow-black/25"
                                role="document"
                            >
                                {{-- Search Input --}}
                                <div
                                    class="relative rounded-t-lg bg-white px-2 pt-2 dark:bg-zinc-800"
                                >
                                    <div
                                        class="flex w-full items-center rounded-lg bg-zinc-100 px-3 dark:bg-zinc-700/75"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                            data-slot="icon"
                                            stroke-width="1.5"
                                            class="hi-mini hi-magnifying-glass inline-block size-6 opacity-50"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>

                                        <input
                                            x-ref="searchFilter"
                                            x-model="searchFilterTerm"
                                            x-on:input.debounce.300ms="filterSearch($event)"
                                            x-on:keydown.enter.prevent.stop="onSearchOptionSelected()"
                                            x-on:keydown.up.prevent.stop="navigateSearchResults('previous')"
                                            x-on:keydown.down.prevent.stop="navigateSearchResults('next')"
                                            x-on:keydown.home.prevent.stop="navigateSearchResults('first')"
                                            x-on:keydown.end.prevent.stop="navigateSearchResults('last')"
                                            x-on:keydown.page-up.prevent.stop="navigateSearchResults('first')"
                                            x-on:keydown.page-down.prevent.stop="navigateSearchResults('last')"
                                            type="text"
                                            class="w-full border-none bg-transparent py-3 text-sm placeholder:text-zinc-500 focus:outline-hidden focus:ring-0 dark:placeholder:text-zinc-400"
                                            placeholder="Search..."
                                            tabindex="0"
                                            role="combobox"
                                            aria-expanded="true"
                                            aria-autocomplete="list"
                                        />
                                        <svg
                                            x-show="searchLoading"
                                            class="inline-block size-6 animate-spin opacity-50"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                        >
                                            <circle
                                                class="opacity-25"
                                                cx="12"
                                                cy="12"
                                                r="10"
                                                stroke="currentColor"
                                                stroke-width="4"
                                            ></circle>
                                            <path
                                                class="opacity-75"
                                                fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                            ></path>
                                        </svg>
                                    </div>
                                </div>
                                {{-- EMD Search Input --}}

                                {{-- Listbox --}}
                                <ul
                                    x-show="searchFilterResults.length > 0"
                                    x-ref="searchListbox"
                                    x-on:mousemove.throttle="enableMouseInteraction()"
                                    x-on:mouseleave="setSearchHighlighted(null)"
                                    class="max-h-72 overflow-auto rounded-b-xl bg-white p-2 dark:bg-zinc-800"
                                    role="listbox"
                                >
                                    <template x-for="option in searchFilterResults" :key="option.id">
                                        <li
                                            x-on:click="onSearchOptionSelected()"
                                            x-on:mouseenter="setSearchHighlighted(option.id, 'mouse')"
                                            x-bind:class="{
                                'text-white bg-zinc-600 dark:text-white dark:bg-zinc-600': isSearchHighlighted(
                                    option.id,
                                ),
                                'text-zinc-600 dark:text-zinc-300': ! isSearchHighlighted(option.id),
                            }"
                                            x-bind:data-selected="isSearchHighlighted(option.id)"
                                            x-bind:data-id="option.id"
                                            x-bind:data-label="option.text"
                                            x-bind:aria-selected="isSearchHighlighted(option.id)"
                                            class="group flex cursor-pointer flex-col rounded-lg px-3 py-3 text-sm"
                                            role="option"
                                            tabindex="-1"
                                        >
                                            <div class="flex grow items-center">
                                                <div
                                                    x-text="option.text"
                                                    class="font-medium"
                                                ></div>
                                            </div>
                                            <div class="flex-none text-xs font-semibold opacity-75">
                                                <span x-text="option.slug"></span>
                                            </div>
                                        </li>
                                    </template>
                                </ul>
                                {{-- END Listbox --}}

                                {{-- No Results Feedback --}}
                                <div
                                    x-show="searchFilterResults.length === 0"
                                    class="rounded-b-xl bg-white p-3 dark:bg-zinc-800"
                                >
                                    <div
                                        class="space-y-3 py-1.5 text-center text-sm text-zinc-500 dark:text-zinc-400"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            data-slot="icon"
                                            class="hi-outline hi-x-circle inline-block size-8 opacity-50"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                            />
                                        </svg>
                                        <p>No search results</p>
                                    </div>
                                </div>
                                {{-- END No Results Feedback --}}
                            </div>
                            {{-- END Command Palette Container --}}
                        </div>
                        {{-- END Search Modal --}}
                    </x-prezet.alpine>
                </div>
            </x-prezet.alpine>
        </div>
    </body>
</html>
