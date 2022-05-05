<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('app.name', 'Vote App') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open_Sans:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-sans text-gray-900 text-sm bg-gray-background">
<header class="flex items-center justify-between px-8 py-4  flex-col md:flex-row">
    <a href="#" class="font-bold">logo</a>
    <div class="flex justify-between items-center mt-2 md:mt-0">
        @if (Route::has('login'))
            <div class=" px-6 py-4">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a href="{{route('logout')}}"
                           onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </a>

                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log
                                in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
                @endauth
            </div>
        @endif
        <a href="#">
            <img src="{{asset('Image/icons8-circled-user-male-skin-type-6-80.png')}}" alt="avatar" class="w-10 h-10">
        </a>
    </div>

</header>
<main class="mx-auto flex container max-w-5xl flex-col md:flex-row">
    <div class="max-w-xs mx-auto md:mr-10">
        <div class="bg-white border-2  border-blue rounded-xl mt-16 border-opacity-40 md:sticky top-10">
            <div class="text-center px-6 py-2 pt-6">
                <h3 class="font-semibold text-base">Add a Idea</h3>

                <p class="text-xs mt-4 ">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis,
                    quisquam?</p>


            </div>

            @livewire('create-idea')


        </div>
    </div>
    <div class="md:max-w-2xl w-full px-4 md:px-0">
        <nav class=" justify-between items-center text-xs hidden md:flex">
            <ul class="uppercase font-semibold space-x-10 border-b-4 pb-3 flex">
                <li><a href="" class="border-b-blue border-b-4 pb-3">All Ideas (87)</a></li>
                <li><a href=""
                       class="text-gray-400 transition duration-200 ease-in border-b-4 pb-3 hover:border-b-blue hover:text-black">Considering
                        (6)</a></li>
                <li><a href=""
                       class="text-gray-400 transition duration-200 ease-in border-b-4 pb-3 hover:border-b-blue hover:text-black">In
                        Process (1)</a></li>

            </ul>
            <ul class="uppercase font-semibold space-x-10 border-b-4 pb-3 flex ml-20">
                <li><a href=""
                       class="text-gray-400 transition duration-200 ease-in border-b-4 pb-3 hover:border-b-blue hover:text-black">implemented
                        (10)</a></li>
                <li><a href=""
                       class="text-gray-400 transition duration-200 ease-in border-b-4 pb-3 hover:border-b-blue hover:text-black">closed
                        (55)</a></li>

            </ul>

        </nav>

        <div class="mt-6">
            {{ $slot }}
        </div>
    </div>
</main>


@livewireScripts
</body>
</html>
