<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <title>{{ $title ?? 'Banco' }}</title>
</head>

<body class="relative min-h-screen">

    <a href="{{ route('home') }}"
        class="absolute top-4 left-4 flex items-center text-blue-600 hover:text-blue-800 transition">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        <span class="ml-1">Voltar</span>
    </a>

    <div class="p-6 pt-16">
        {{ $slot }}
    </div>
    @livewireScripts
</body>

</html>