<!DOCTYPE html>
<html lang="en" data-theme="cupcake">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'BorrowBox')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/logo-gopinjam.svg') }}">
    @vite('resources/css/app.css')
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</head>
<body>
    @yield('content')
</body>
</html>