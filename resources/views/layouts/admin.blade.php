<!DOCTYPE html>
<html class="overflow-y-scroll" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel')) - Admin</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/logo-gopinjam.svg') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    @stack('styles')
</head>
<body class="font-sans antialiased bg-neutralize">
    <div class="max-w-400 mx-auto">
        <div class="flex min-h-screen">

            @include('partials.admin.sidebar')

            <div class="flex-1 flex flex-col">

                @include('partials.admin.navbar')

                <main class="flex-1 p-6 lg:p-8">
                    @yield('content')
                </main>

            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>