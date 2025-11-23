<!DOCTYPE html>
<html>
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'Projects Manager')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="min-h-screen flex flex-col">
        @yield('content')
    </div>
</body>
</html>
