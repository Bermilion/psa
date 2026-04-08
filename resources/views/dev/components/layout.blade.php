<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Styles -->
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-gray-50">
    <div class="max-w-5xl mx-auto p-32">
        @if (request()->getPathinfo() !=='/dev')
            <x-dev.type.link variant="dark" href="{{ asset('/dev') }}" text="Назад" />
        @endif
        @yield('content')
    </div>
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</body>
</html>
