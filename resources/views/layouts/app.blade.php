<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-900">
    @include('layouts.header')

    <main class="container mx-auto p-6">
        @yield('content')
    </main>

    @include('layouts.footer')
    @livewireScripts
    @vite('resources/js/app.js')
</body>
</html>
