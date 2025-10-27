<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield("name")</title>
</head>
<header>
<nav class="flex items-center justify-between p-4 bg-gray-500 shadow-sm rounded-box shadow-base-300/20"">
    <a href="{{ url('/') }}" class="p-2 text-white bg-black rounded-lg">Menu</a>
    @if (Auth::check())
         <a href="{{ route('user.create') }}" class="p-2 text-white bg-black rounded-lg">Création d'univers</a>
        <a href="{{ route('dashboard') }}" class="p-2 text-white bg-black rounded-lg">Dashboard</a>
            <div class="hidden sm:flex sm:items-center sm:ms-6 ">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-black border border-transparent rounded-md dark:text-white dark:bg-black hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Déconnexion') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

    @endif
    @if (!Auth::check())
        <a href="{{ route('login') }}" class="p-2 text-white bg-black rounded-lg">Connection</a>
        <a href="{{ route('register') }}" class="p-2 text-white bg-black rounded-lg">S'inscrire</a>
    @endif

</nav>
</header>
<body>
    @yield("content")
</body>
</html>
