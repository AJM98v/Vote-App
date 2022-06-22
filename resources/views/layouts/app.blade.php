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
                    <div class="flex items-center space-x-3 justify-center">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a href="{{route('logout')}}"
                               onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>

                        <div class="relative" x-data="{
                            isOpen : false
                            }" @keydown.esc.window="isOpen =false">
                            <button class="relative" @click="isOpen = !isOpen">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                <span
                                    class="absolute bg-red text-white rounded-full px-2 text-xxs -top-3 -right-3 shadow-sm shadow-gray-500">3</span>
                            </button>

                            <ul @click.outside="isOpen = false"
                                x-show="isOpen" x-transition.origin.top.left.duration.200ms x-cloak
                                class="md:max-h-96 max-h-72 overflow-y-auto absolute p-0 md:w-72 w-64 font-light text-xs shadow-lg   bg-white overflow-hidden text-left md:-right-1  -right-28 mt-1 md:mt-2 rounded-xl  z-20">
                                <li class="flex px-5 py-2 cursor-pointer hover:bg-gray-100 transition-all ease-in duration-300">
                                    <img src="#" alt="avatar">
                                    <div class="ml-4">
                                        <div class="text-gray-800 line-clamp-5">
                                            <p><span class="text-black font-bold">Abolfazl Jafari</span> Commented
                                                On <span class="text-black font-bold">My Idea 1</span> : <span
                                                    class="font-bold  text-black text-xxs">"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi eaque laboriosam libero nesciunt non quasi. Aut exercitationem expedita reiciendis soluta. Incidunt, iure numquam. Accusamus, amet aut, commodi corporis cumque dolorum eligendi explicabo magni molestias quibusdam rem sapiente sint voluptate voluptatum?"</span>
                                            </p>
                                        </div>
                                        <span class="text-xxs text-gray-500 mt-2">1 Hour ago</span>
                                    </div>
                                </li>
                                      <li class="flex px-5 py-2 cursor-pointer hover:bg-gray-100 transition-all ease-in duration-300">
                                    <img src="#" alt="avatar">
                                    <div class="ml-4">
                                        <div class="text-gray-800 line-clamp-5">
                                            <p><span class="text-black font-bold">Abolfazl Jafari</span> Commented
                                                On <span class="text-black font-bold">My Idea 1</span> : <span
                                                    class="font-bold  text-black text-xxs">"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi eaque laboriosam libero nesciunt non quasi. Aut exercitationem expedita reiciendis soluta. Incidunt, iure numquam. Accusamus, amet aut, commodi corporis cumque dolorum eligendi explicabo magni molestias quibusdam rem sapiente sint voluptate voluptatum?"</span>
                                            </p>
                                        </div>
                                        <span class="text-xxs text-gray-500 mt-2">1 Hour ago</span>
                                    </div>
                                </li>
                                      <li class="flex px-5 py-2 cursor-pointer hover:bg-gray-100 transition-all ease-in duration-300">
                                    <img src="#" alt="avatar">
                                    <div class="ml-4">
                                        <div class="text-gray-800 line-clamp-5">
                                            <p><span class="text-black font-bold">Abolfazl Jafari</span> Commented
                                                On <span class="text-black font-bold">My Idea 1</span> : <span
                                                    class="font-bold  text-black text-xxs">"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi eaque laboriosam libero nesciunt non quasi. Aut exercitationem expedita reiciendis soluta. Incidunt, iure numquam. Accusamus, amet aut, commodi corporis cumque dolorum eligendi explicabo magni molestias quibusdam rem sapiente sint voluptate voluptatum?"</span>
                                            </p>
                                        </div>
                                        <span class="text-xxs text-gray-500 mt-2">1 Hour ago</span>
                                    </div>
                                </li>
                                      <li class="flex px-5 py-2 cursor-pointer hover:bg-gray-100 transition-all ease-in duration-300">
                                    <img src="#" alt="avatar">
                                    <div class="ml-4">
                                        <div class="text-gray-800 line-clamp-5">
                                            <p><span class="text-black font-bold">Abolfazl Jafari</span> Commented
                                                On <span class="text-black font-bold">My Idea 1</span> : <span
                                                    class="font-bold  text-black text-xxs">"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi eaque laboriosam libero nesciunt non quasi. Aut exercitationem expedita reiciendis soluta. Incidunt, iure numquam. Accusamus, amet aut, commodi corporis cumque dolorum eligendi explicabo magni molestias quibusdam rem sapiente sint voluptate voluptatum?"</span>
                                            </p>
                                        </div>
                                        <span class="text-xxs text-gray-500 mt-2">1 Hour ago</span>
                                    </div>
                                </li>
                                      <li class="flex px-5 py-2 cursor-pointer hover:bg-gray-100 transition-all ease-in duration-300">
                                    <img src="#" alt="avatar">
                                    <div class="ml-4">
                                        <div class="text-gray-800 line-clamp-5">
                                            <p><span class="text-black font-bold">Abolfazl Jafari</span> Commented
                                                On <span class="text-black font-bold">My Idea 1</span> : <span
                                                    class="font-bold  text-black text-xxs">"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi eaque laboriosam libero nesciunt non quasi. Aut exercitationem expedita reiciendis soluta. Incidunt, iure numquam. Accusamus, amet aut, commodi corporis cumque dolorum eligendi explicabo magni molestias quibusdam rem sapiente sint voluptate voluptatum?"</span>
                                            </p>
                                        </div>
                                        <span class="text-xxs text-gray-500 mt-2">1 Hour ago</span>
                                    </div>
                                </li>
                                      <li class="flex px-5 py-2 cursor-pointer hover:bg-gray-100 transition-all ease-in duration-300">
                                    <img src="#" alt="avatar">
                                    <div class="ml-4">
                                        <div class="text-gray-800 line-clamp-5">
                                            <p><span class="text-black font-bold">Abolfazl Jafari</span> Commented
                                                On <span class="text-black font-bold">My Idea 1</span> : <span
                                                    class="font-bold  text-black text-xxs">"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi eaque laboriosam libero nesciunt non quasi. Aut exercitationem expedita reiciendis soluta. Incidunt, iure numquam. Accusamus, amet aut, commodi corporis cumque dolorum eligendi explicabo magni molestias quibusdam rem sapiente sint voluptate voluptatum?"</span>
                                            </p>
                                        </div>
                                        <span class="text-xxs text-gray-500 mt-2">1 Hour ago</span>
                                    </div>
                                </li>


                                <li class="border-t border-gray-600 hover:text-white hover:bg-gray-600 flex space-x-2 items-center justify-center text-sm w-full py-2  cursor-pointer transition-all ease-in duration-300">
                                    <button >Mark All As Read</button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </li>
                            </ul>

                        </div>

                    </div>

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

                <p class="text-xs mt-4 ">Your Idea IS Gold Please Share Us</p>


            </div>

            @livewire('create-idea')


        </div>
    </div>
    <div class="md:max-w-2xl w-full px-4 md:px-0">
        @livewire('status-filters')

        <div class="mt-6">
            {{ $slot }}
        </div>
    </div>
</main>


@livewireScripts
</body>
</html>
