<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>@yield("name")</title>
</head>
<header>
<nav class="navbar rounded-box shadow-base-300/20 shadow-sm p-4 bg-amber-100">
    <a href="" class="p-2 bg-black text-white rounded-lg">Menu</a>
    <a href="{{ route('user.create') }}" class="p-2 bg-black text-white rounded-lg">Inscription</a>
</nav>
</header>
<body>
    @yield("content")
</body>
</html>
