<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Jornada') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%236366f1'><path d='M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z'/></svg>">
    </head>
    <body class="font-sans antialiased bg-gray-50 min-h-screen flex flex-col" x-data="{ sidebarOpen: false }" @keydown.escape.window="sidebarOpen = false">
        <div class="flex flex-1 min-h-0">
            @auth
                @include('layouts.sidebar')
            @endauth
            <div class="flex-1 flex flex-col min-h-screen transition-all duration-300 {{ auth()->check() ? 'ml-0 sm:ml-64' : '' }}">
                @include('layouts.navigation')

                <!-- Page Content -->
                <main class="flex-1 py-8">
                    <div class="max-w-7xl sm:px-6 lg:px-8">
                        @isset($header)
                            <div class="bg-white shadow-sm rounded-t-lg mb-6">
                                <div class="px-4 py-4 sm:px-6 lg:px-8">
                                    {{ $header }}
                                </div>
                            </div>
                        @endisset

                        {{ $slot }}
                    </div>
                </main>

                <!-- Footer -->
                <footer class="bg-white border-t mt-auto">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        <p class="text-center text-sm text-gray-500">
                            &copy; {{ date('Y') }} Jornada. Todos os direitos reservados.
                        </p>
                    </div>
                </footer>
            </div>
        </div>
        @stack('scripts')
    </body>
</html>
