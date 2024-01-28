<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>Livewire To-Dos</title>
    @livewireStyles
    @vite('resources/css/app.css')
</head>

<body class="text-gray-50 bg-zinc-900">
    {{ $slot }}

    @livewireScripts
</body>

</html>
