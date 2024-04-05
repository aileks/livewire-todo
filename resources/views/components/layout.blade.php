<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>Livewire To-Dos</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="antialiased text-gray-50 bg-zinc-900">
    {{ $slot }}

    @livewireScripts
    <script>
        Livewire.onPageExpired((response, message) => {})
    </script>
</body>

</html>
