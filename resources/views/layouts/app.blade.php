<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 min-h-screen">
    <div class="flex flex-col min-h-screen">
        <!-- Navigation -->
        <header class="fixed  bg-white top-0 left-0 w-full z-10 shadow-md">
            @include('layouts.navigation')
        </header>

        <!-- Main Content Area -->
        <div class="flex flex-1 mt-2 overflow-hidden">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Page Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                @isset($header)
                    <header class="bg-white shadow mb-6">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <div class="bg-white p-6 rounded-lg shadow-md mt-12">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>

</html>