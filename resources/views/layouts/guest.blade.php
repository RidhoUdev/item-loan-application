<!DOCTYPE html>
<html lang="en" data-theme="cupcake">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'BorrowBox')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('img/logo-borrowbox.svg') }}">
    @vite('resources/css/app.css')
</head>
<body>
    @yield('content')
</body>
</html>