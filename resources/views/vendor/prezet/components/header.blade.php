<header
    @class([
            'sticky top-0 z-50 flex flex-none flex-wrap items-center justify-between  px-4 py-5 shadow-md shadow-stone-900/5 transition duration-500 sm:px-6 lg:px-8',
            'bg-stone-900' => route('prezet.index') === url()->current(),
            'bg-white' => route('prezet.index') !== url()->current(),
        ])
>
    <div class="relative flex flex-grow basis-0 items-center">
        @if(route('prezet.index') !== url()->current())
        <button
            aria-label="Menu"
            class="mr-4 rounded-lg p-1.5 hover:bg-stone-100 active:bg-stone-200 lg:hidden"
            x-on:click="showSidebar = ! showSidebar"
        >
            <svg
                class="h-6 w-6 text-stone-600"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <line x1="4" x2="20" y1="12" y2="12"></line>
                <line x1="4" x2="20" y1="6" y2="6"></line>
                <line x1="4" x2="20" y1="18" y2="18"></line>
            </svg>
        </button>
        @endif

        <a aria-label="Home" href="{{ route('prezet.index') }}">
            <svg
                class="h-9 w-auto"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 141 36"
            >
                <path
                    d="m5 31 7-26h5l-7 26H5ZM18 14V9l13 6.5v5L18 27v-5l8-4-8-4Z"
                    class="fill-orange-600"
                />
                <path
                    d="M44.517 27V9.545h6.886c1.324 0 2.452.253 3.384.759.932.5 1.642 1.196 2.13 2.088.495.886.742 1.91.742 3.068 0 1.16-.25 2.182-.75 3.068-.5.887-1.224 1.577-2.173 2.071-.943.495-2.085.742-3.426.742h-4.39v-2.957h3.793c.71 0 1.295-.123 1.756-.367.466-.25.812-.594 1.04-1.031.233-.443.349-.952.349-1.526 0-.58-.116-1.085-.35-1.517a2.333 2.333 0 0 0-1.04-1.014c-.465-.244-1.056-.367-1.772-.367h-2.489V27h-3.69Zm15.54 0V9.545h6.885c1.319 0 2.444.236 3.376.708.937.466 1.65 1.128 2.139 1.986.494.852.741 1.855.741 3.008 0 1.16-.25 2.156-.75 2.992-.5.83-1.224 1.465-2.173 1.909-.943.443-2.085.665-3.426.665h-4.611v-2.966h4.014c.705 0 1.29-.097 1.756-.29.466-.193.812-.483 1.04-.87.233-.386.349-.866.349-1.44 0-.58-.117-1.068-.35-1.466-.227-.398-.576-.699-1.048-.903-.466-.21-1.054-.316-1.764-.316h-2.489V27h-3.69Zm9.425-7.943L73.82 27h-4.074l-4.244-7.943h3.98ZM75.806 27V9.545h11.761v3.043h-8.07v4.16h7.465v3.042h-7.466v4.167h8.106V27H75.806Zm14.508 0v-2.19l8.71-12.222h-8.727V9.545h13.364v2.19l-8.72 12.222h8.737V27H90.314Zm16.195 0V9.545h11.762v3.043H110.2v4.16h7.465v3.042H110.2v4.167h8.105V27h-11.796Zm14.031-14.412V9.545h14.335v3.043h-5.344V27h-3.647V12.588h-5.344Z"
                    @class([
                        'fill-stone-300' => route('prezet.index') === url()->current(),
                        'fill-stone-900' => route('prezet.index') !== url()->current(),
                    ])
                />
            </svg>
        </a>
    </div>
    <div
        class="relative flex basis-0 items-center justify-end gap-3 sm:gap-8 md:flex-grow lg:gap-6"
    >
        @if(!request()->route()->named('prezet.index'))
            <x-version-select />
            <x-prezet::search />
        @endif
        <a
            class="group"
            aria-label="GitHub"
            href="https://github.com/prezet/prezet"
            target="_blank"
        >
            <svg
                aria-hidden="true"
                viewBox="0 0 16 16"
                class="h-6 w-6 fill-stone-400 group-hover:fill-stone-500"
            >
                <path
                    d="M8 0C3.58 0 0 3.58 0 8C0 11.54 2.29 14.53 5.47 15.59C5.87 15.66 6.02 15.42 6.02 15.21C6.02 15.02 6.01 14.39 6.01 13.72C4 14.09 3.48 13.23 3.32 12.78C3.23 12.55 2.84 11.84 2.5 11.65C2.22 11.5 1.82 11.13 2.49 11.12C3.12 11.11 3.57 11.7 3.72 11.94C4.44 13.15 5.59 12.81 6.05 12.6C6.12 12.08 6.33 11.73 6.56 11.53C4.78 11.33 2.92 10.64 2.92 7.58C2.92 6.71 3.23 5.99 3.74 5.43C3.66 5.23 3.38 4.41 3.82 3.31C3.82 3.31 4.49 3.1 6.02 4.13C6.66 3.95 7.34 3.86 8.02 3.86C8.7 3.86 9.38 3.95 10.02 4.13C11.55 3.09 12.22 3.31 12.22 3.31C12.66 4.41 12.38 5.23 12.3 5.43C12.81 5.99 13.12 6.7 13.12 7.58C13.12 10.65 11.25 11.33 9.47 11.53C9.76 11.78 10.01 12.26 10.01 13.01C10.01 14.08 10 14.94 10 15.21C10 15.42 10.15 15.67 10.55 15.59C13.71 14.53 16 11.53 16 8C16 3.58 12.42 0 8 0Z"
                ></path>
            </svg>
        </a>
    </div>
</header>
