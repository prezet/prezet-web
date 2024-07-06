<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <style type="text/css">
            @font-face {
                font-family: 'Inter';
                font-style: normal;
                font-weight: 400;
                font-stretch: 100%;
                font-display: optional;
                src: url(https://fonts.bunny.net/inter/files/inter-latin-400-normal.woff2) format('woff2'), url(https://fonts.bunny.net/inter/files/inter-latin-400-normal.woff) format('woff');
                unicode-range: U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;
            }
            @font-face {
                font-family: 'Inter';
                font-style: normal;
                font-weight: 500;
                font-stretch: 100%;
                font-display: optional;
                src: url(https://fonts.bunny.net/inter/files/inter-latin-500-normal.woff2) format('woff2'), url(https://fonts.bunny.net/inter/files/inter-latin-500-normal.woff) format('woff');
                unicode-range: U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;
            }
            @font-face {
                font-family: 'Inter';
                font-style: normal;
                font-weight: 600;
                font-stretch: 100%;
                font-display: optional;
                src: url(https://fonts.bunny.net/inter/files/inter-latin-600-normal.woff2) format('woff2'), url(https://fonts.bunny.net/inter/files/inter-latin-600-normal.woff) format('woff');
                unicode-range: U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;
            }
            @font-face {
                font-family: 'Inter';
                font-style: normal;
                font-weight: 700;
                font-stretch: 100%;
                font-display: optional;
                src: url(https://fonts.bunny.net/inter/files/inter-latin-700-normal.woff2) format('woff2'), url(https://fonts.bunny.net/inter/files/inter-latin-700-normal.woff) format('woff');
                unicode-range: U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;
            }
        </style>

        <x-seo::meta />

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

        <!-- Scripts -->
        <script
            defer
            src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"
        ></script>
        <script
            defer
            src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
        ></script>
        @vite(['resources/css/app.css'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            <x-prezet::alpine>
                <x-prezet::header />
                @if (isset($hero))
                    {{ $hero }}
                @else
                <div
                    class="relative mx-auto flex w-full max-w-8xl flex-auto justify-center sm:px-2 lg:px-8 xl:px-12"
                >
                    {{-- Left Sidebar --}}
                    @if (isset($left))
                        {{ $left }}
                    @endif

                    {{-- Main Content --}}
                    <main
                        class="min-w-0 max-w-2xl flex-auto px-4 py-16 lg:max-w-none lg:pl-8 lg:pr-0 xl:px-16"
                    >
                        {{ $slot }}
                    </main>

                    {{-- Right Sidebar --}}
                    @if (isset($right))
                        {{ $right }}
                    @endif
                </div>
                @endif
            </x-prezet::alpine>
        </div>
    </body>
</html>
