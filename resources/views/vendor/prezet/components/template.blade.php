<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=Inter:400,500,600,700&display=swap"
            rel="stylesheet"
        />

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
