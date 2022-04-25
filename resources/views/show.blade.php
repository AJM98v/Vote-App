<x-app-layout>
    <div>
        <a href="/" class="flex items-center font-semibold hover:underline">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="ml-2">All Ideas</span>
        </a>
    </div>

    <div
        class="idea-container mt-5 bg-white rounded-xl  flex ">
        <div class="flex flex-1 px-4 py-6 ">
            <a href="#" class="flex-none h-fit">
                <img src="https://source.unsplash.com/200*200/?face&crop=face&v=1" alt="avatar"
                     class="w-14 h-14 rounded-2xl">
            </a>
            <div class="mx-4 w-full">
                <h4 class="text-xl font-semibold ">
                    <a href="#" class="hover:underline">Random title Goes here</a>
                </h4>
                <div class="text-gray-600 mt-4 line-clamp-3">Lorem ipsum
                </div>
                <div class="flex justify-between items-center mt-5">
                    <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                        <div class="font-bold text-gray-900">Abolfazl Jafari</div>
                        <div>&bull;</div>
                        <div>10 hours ago</div>
                        <div>&bull;</div>
                        <div>Category</div>
                        <div>&bull;</div>
                        <div class="text-gray-800">3 comment</div>
                        <div>&bull;</div>

                    </div>
                    <div class="flex space-x-2 items-center">
                        <div
                            class="bg-gray-300 text-xxs font-bold uppercase leading-none text-center w-28 rounded-full h-7 py-2 px-4">
                            Open
                        </div>

                        <button
                            class="relative bg-gray-200 hover:bg-gray-300 rounded-full h-7 px-2 transition duration-300 ease-in ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                            </svg>
                            <ul class="hidden absolute p-0 w-44 font-semibold text-sm shadow-lg  bg-white overflow-hidden text-left left-5 rounded-xl ">
                                <li><a href="#"
                                       class="hover:bg-gray-200 px-5 py-3 block transition w-full duration-200 ease-in">Mark
                                        As Spam</a></li>
                                <li><a href="#"
                                       class="hover:bg-gray-200 px-5 py-3 block transition w-full duration-200 ease-in">Delete
                                        Post</a></li>
                            </ul>
                        </button>


                    </div>
                </div>
            </div>


        </div>

    </div> <!--end idea-container-->
    <div class="buttons  px-5 py-8 flex items-center w-full justify-between">
        <div class="flex justify-center space-x-3 items-center">
            <button
                class=" flex items-center rounded-xl bg-blue hover:bg-blue-hover px-6 py-3 text-white text-xs h-9 w-32 justify-center transition duration-200 ease-in font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4 text-gray-200" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                </svg>
                <span>Replay</span>
            </button>
            <button
                class="flex items-center py-3 px-6 justify-center w-32 h-9 text-xs bg-gray-200 font-semibold rounded-xl border transition duration-200 ease-in border-gray-200 hover:border-gray-400">
                <span class="mr-2">Set Status</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>

            </button>

        </div>
        <div class="flex justify-center items-center space-x-3">
            <div class="bg-white font-semibold text-center rounded-xl px-3 py-2 shadow drop-shadow">
                <div class="text-xl leading-snug text-xs uppercase">12</div>
                <div class="text-gray-400 leading-none text-xs uppercase">Votes</div>
            </div>
            <button
                class="uppercase font-bold py-2 px-6 justify-center w-32 h-9 text-xs bg-gray-200 font-semibold rounded-xl border transition duration-200 ease-in border-gray-200 hover:border-gray-400">
                Vote
            </button>

        </div>

    </div>


</x-app-layout>
