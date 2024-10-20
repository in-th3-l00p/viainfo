<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ViaInfo</title>

    @vite([
        "resources/scss/app.scss",
        "resources/js/app.js"
    ])
    @stack("vite")
    @livewireStyles
</head>
<body class="w-screen overflow-x-hidden">
    <x-ui.success-notification />
    @yield("content")
    @livewireScripts
</body>
</html>
