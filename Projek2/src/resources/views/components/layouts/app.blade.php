<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Aplikasi Klinik' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-800">

<div class="flex">
    @include('components.partials.sidebar')

    <main class="flex-1 p-6">
        {{ $slot }}
    </main>
</div>

@livewireScripts
</body>
</html>
