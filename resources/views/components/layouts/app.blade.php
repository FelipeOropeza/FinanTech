<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @livewireStyles
    <title>{{ $title ?? 'Page Title' }}</title>
    @stack('scripts')
</head>

<body>
    <livewire:layouts.nav-bar />
    {{ $slot }}
    <x-partials.footer />
    @livewireScripts
</body>

</html>