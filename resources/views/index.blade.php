<x-app-layout>
    <div
        class="filters flex flex-col md:flex-row md:items-center md:justify-center md:space-x-6 space-y-4 md:space-y-0">
        <div class="w-full md:w-1/3">
            <select name="category" id="category" class="w-full rounded-xl px-4 py-2 border-none">
                <option value="Category One">Category One</option>
                <option value="Category Two">Category Two</option>
                <option value="Category three">Category three</option>
                <option value="Category four">Category four</option>
            </select>
        </div>
        <div class="w-full md:w-1/3">
            <select name="other_filter" id="other_filter" class="w-full rounded-xl px-4 py-2 border-none">
                <option value="Filter One">Filter One</option>
                <option value="Filter Two">Filter Two</option>
                <option value="Filter three">Filter three</option>
                <option value="Filter four">Category four</option>
            </select>
        </div>
        <div class="w-full md:w-2/3 relative">
            <div class="absolute top-0 flex items-center h-full ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>

            <input type="search" placeholder="Find Ideas"
                   class="placeholder-gray-900 rounded-xl border-none w-full bg-white px-4 py-2 pl-10">
        </div>


    </div>
    {{--    end filters--}}


    <div class="ideas-container space-y-6 my-6">
        <div
            class="idea-container bg-white rounded-xl cursor-pointer flex hover:shadow-card transition duration-200 ease-in">
            <div class="border-r border-gray-200 px-5 py-8 hidden md:block">
                <div class="text-center">
                    <div class="font-semibold text-2xl ">12</div>
                    <div class="text-gray-500">Votes</div>

                </div>
                <div class="mt-8">
                    <button
                        class="w-20 bg-gray-300 font-bold text-xxs uppercase rounded-xl px-4 py-3 transition duration-300 ease-in border border-gray-200 hover:border-gray-400">
                        Vote
                    </button>
                </div>

            </div>
            <div class="flex flex-1 px-2 py-6 flex-col  md:flex-row">
                <a href="#" class="flex-none h-fit m-3 md:m-0">
                    <img src="https://source.unsplash.com/200*200/?face&crop=face&v=1" alt="avatar"
                         class="w-14 h-14 rounded-2xl">
                </a>
                <div class="px-4 w-full flex flex-col justify-between">
                    <h4 class="text-xl font-semibold ">
                        <a href="#" class="hover:underline">Random title Goes here</a>
                    </h4>
                    <div class="text-gray-600 mt-4 line-clamp-3 px-4 md:px-2">Lorem ipsum dolor sit amet, consectetur
                        adipisicing
                        elit. Nemo nesciunt provident saepe! Aspernatur assumenda debitis necessitatibus nobis quia
                        quisquam. Iure!
                    </div>
                    <div class="flex justify-between md:items-center mt-5 flex-col md:flex-row space-y-4 md:space-y-0 ">
                        <div
                            class="flex items-center w-fit space-x-2  md:w-2/3  text-xs text-gray-400 font-semibold  md:space-x-2 justify-between  md:justify-start">
                            <div>10 hours ago</div>
                            <div>&bull;</div>
                            <div>Category</div>
                            <div>&bull;</div>
                            <div class="text-gray-800">3 comment</div>
                            <div>&bull;</div>

                        </div>
                        <div class="flex justify-between items-center px-4">
                            <div class="md:hidden flex items-center">
                                <div class="bg-gray-200  text-center text-xxs rounded-l-2xl h-10 px-4 py-2">
                                    <div class="font-bold leading-none text-xs">12</div>
                                    <div class="font-bold uppercase text-gray-600 ">Votes</div>
                                </div>
                                <button
                                    class="px-3 py-2 h-10 rounded-2xl  uppercase hover:bg-gray-600 transition duration-300 ease-in hover:border-gray-300 border hover:text-white -mx-3 font-bold bg-gray-400 ">

                                Vote
                                </button>
                            </div>
                            <div class="flex space-x-2 items-center">
                                <div
                                    class="bg-gray-300 text-xxs font-bold uppercase leading-none text-center w-28 rounded-full h-7 py-2 px-4">
                                    Open
                                </div>

                                <button x-data="{
                            isOpen : false
                            }" @click="isOpen = !isOpen" @keydown.esc.window="isOpen =false"
                                        class="relative bg-gray-200 hover:bg-gray-300 rounded-full h-7 px-2 transition duration-300 ease-in ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                                    </svg>
                                    <ul @click.outside="isOpen = false"
                                        x-show="isOpen" x-transition.origin.top.left.duration.200ms x-cloak
                                        class="absolute p-0 w-44 font-semibold text-sm shadow-lg   bg-white overflow-hidden text-left right-0 md:left-5  mt-1 md:mt-0 rounded-xl ">
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


            </div>

        </div> <!--end idea-container-->
        <div
            class="idea-container bg-white rounded-xl cursor-pointer flex hover:shadow-card transition duration-200 ease-in">
            <div class="border-r border-gray-200 px-5 py-8">
                <div class="text-center">
                    <div class="font-semibold text-2xl text-blue ">12</div>
                    <div class="text-gray-600">Votes</div>

                </div>
                <div class="mt-8">
                    <button
                        class="w-20 bg-blue text-white font-bold text-xxs uppercase rounded-xl px-4 py-3 transition duration-300 ease-in border border-gray-200 hover:border-gray-400">
                        Voted
                    </button>
                </div>

            </div>
            <div class="flex px-2 py-6 ">
                <a href="#" class="flex-none">
                    <img src="https://source.unsplash.com/200*200/?face&crop=face&v=1" alt="avatar"
                         class="w-14 h-14 rounded-2xl">
                </a>
                <div class="mx-4">
                    <h4 class="text-xl font-semibold ">
                        <a href="#" class="hover:underline">Another Random title Goes here</a>
                    </h4>
                    <div class="text-gray-600 mt-4 line-clamp-3">Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Dicta,
                        dolores dolorum ea fugit neque nulla qui quis sunt! Ab adipisci assumenda at culpa dolorum
                        ducimus ea eos expedita explicabo harum labore laboriosam magni maiores mollitia neque non,
                        officia possimus quia quo quod recusandae repudiandae sapiente, suscipit tempore totam, veniam
                        vero.
                    </div>
                    <div class="flex justify-between items-center mt-5">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div>10 hours ago</div>
                            <div>&bull;</div>
                            <div>Category</div>
                            <div>&bull;</div>
                            <div class="text-gray-800">3 comment</div>
                            <div>&bull;</div>

                        </div>
                        <div class="flex space-x-2 items-center">
                            <div
                                class="bg-yellow text-xxs font-bold text-white uppercase leading-none text-center w-28 rounded-full h-7 py-2 px-4">
                                In Process
                            </div>

                            <button
                                class="relative bg-gray-200 hover:bg-gray-300 rounded-full h-7 px-2 transition duration-300 ease-in ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                                </svg>
                                <ul class="absolute p-0 w-44 font-semibold text-sm shadow-lg  bg-white overflow-hidden text-left left-5 rounded-xl ">
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
        <div
            class="idea-container bg-white rounded-xl cursor-pointer flex hover:shadow-card transition duration-200 ease-in">
            <div class="border-r border-gray-200 px-5 py-8">
                <div class="text-center">
                    <div class="font-semibold text-2xl ">12</div>
                    <div class="text-gray-500">Votes</div>

                </div>
                <div class="mt-8">
                    <button
                        class="w-20 bg-gray-300 font-bold text-xxs uppercase rounded-xl px-4 py-3 transition duration-300 ease-in border border-gray-200 hover:border-gray-400">
                        Vote
                    </button>
                </div>

            </div>
            <div class="flex px-2 py-6 ">
                <a href="#" class="flex-none">
                    <img src="https://source.unsplash.com/200*200/?face&crop=face&v=1" alt="avatar"
                         class="w-14 h-14 rounded-2xl">
                </a>
                <div class="mx-4">
                    <h4 class="text-xl font-semibold ">
                        <a href="#" class="hover:underline">Random title Goes here</a>
                    </h4>
                    <div class="text-gray-600 mt-4 line-clamp-3">Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Dicta,
                        dolores dolorum ea fugit neque nulla qui quis sunt! Ab adipisci assumenda at culpa dolorum
                        ducimus ea eos expedita explicabo harum labore laboriosam magni maiores mollitia neque non,
                        officia possimus quia quo quod recusandae repudiandae sapiente, suscipit tempore totam, veniam
                        vero.
                    </div>
                    <div class="flex justify-between items-center mt-5">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div>10 hours ago</div>
                            <div>&bull;</div>
                            <div>Category</div>
                            <div>&bull;</div>
                            <div class="text-gray-800">3 comment</div>
                            <div>&bull;</div>

                        </div>
                        <div class="flex space-x-2 items-center">
                            <div
                                class="bg-red text-white text-xxs font-bold uppercase leading-none text-center w-28 rounded-full h-7 py-2 px-4">
                                Closed
                            </div>

                            <button
                                class="relative bg-gray-200 hover:bg-gray-300 rounded-full h-7 px-2 transition duration-300 ease-in ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                                </svg>
                                <ul class="absolute p-0 w-44 font-semibold text-sm shadow-lg  bg-white overflow-hidden text-left left-5 rounded-xl ">
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
        <div
            class="idea-container bg-white rounded-xl cursor-pointer flex hover:shadow-card transition duration-200 ease-in">
            <div class="border-r border-gray-200 px-5 py-8">
                <div class="text-center">
                    <div class="font-semibold text-2xl ">55</div>
                    <div class="text-gray-500">Votes</div>

                </div>
                <div class="mt-8">
                    <button
                        class="w-20 bg-gray-300 font-bold text-xxs uppercase rounded-xl px-4 py-3 transition duration-300 ease-in border border-gray-200 hover:border-gray-400">
                        Vote
                    </button>
                </div>

            </div>
            <div class="flex px-2 py-6 ">
                <a href="#" class="flex-none">
                    <img src="https://source.unsplash.com/200*200/?face&crop=face&v=1" alt="avatar"
                         class="w-14 h-14 rounded-2xl">
                </a>
                <div class="mx-4">
                    <h4 class="text-xl font-semibold ">
                        <a href="#" class="hover:underline">Random title Goes here</a>
                    </h4>
                    <div class="text-gray-600 mt-4 line-clamp-3">Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Dicta,
                        dolores dolorum ea fugit neque nulla qui quis sunt! Ab adipisci assumenda at culpa dolorum
                        ducimus ea eos expedita explicabo harum labore laboriosam magni maiores mollitia neque non,
                        officia possimus quia quo quod recusandae repudiandae sapiente, suscipit tempore totam, veniam
                        vero.
                    </div>
                    <div class="flex justify-between items-center mt-5">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div>10 hours ago</div>
                            <div>&bull;</div>
                            <div>Category</div>
                            <div>&bull;</div>
                            <div class="text-gray-800">3 comment</div>
                            <div>&bull;</div>

                        </div>
                        <div class="flex space-x-2 items-center">
                            <div
                                class="bg-green text-white text-xxs font-bold uppercase leading-none text-center w-28 rounded-full h-7 py-2 px-4">
                                Implement
                            </div>

                            <button
                                class="relative bg-gray-200 hover:bg-gray-300 rounded-full h-7 px-2 transition duration-300 ease-in ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                                </svg>
                                <ul class="absolute p-0 w-44 font-semibold text-sm shadow-lg  bg-white overflow-hidden text-left left-5 rounded-xl ">
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
        <div
            class="idea-container bg-white rounded-xl cursor-pointer flex hover:shadow-card transition duration-200 ease-in">
            <div class="border-r border-gray-200 px-5 py-8">
                <div class="text-center">
                    <div class="font-semibold text-2xl ">72</div>
                    <div class="text-gray-500">Votes</div>

                </div>
                <div class="mt-8">
                    <button
                        class="w-20 bg-gray-300 font-bold text-xxs uppercase rounded-xl px-4 py-3 transition duration-300 ease-in border border-gray-200 hover:border-gray-400">
                        Vote
                    </button>
                </div>

            </div>
            <div class="flex px-2 py-6 ">
                <a href="#" class="flex-none">
                    <img src="https://source.unsplash.com/200*200/?face&crop=face&v=1" alt="avatar"
                         class="w-14 h-14 rounded-2xl">
                </a>
                <div class="mx-4">
                    <h4 class="text-xl font-semibold ">
                        <a href="#" class="hover:underline">Random title Goes here</a>
                    </h4>
                    <div class="text-gray-600 mt-4 line-clamp-3">Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Dicta,
                        dolores dolorum ea fugit neque nulla qui quis sunt! Ab adipisci assumenda at culpa dolorum
                        ducimus ea eos expedita explicabo harum labore laboriosam magni maiores mollitia neque non,
                        officia possimus quia quo quod recusandae repudiandae sapiente, suscipit tempore totam, veniam
                        vero.
                    </div>
                    <div class="flex justify-between items-center mt-5">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div>10 hours ago</div>
                            <div>&bull;</div>
                            <div>Category</div>
                            <div>&bull;</div>
                            <div class="text-gray-800">3 comment</div>
                            <div>&bull;</div>

                        </div>
                        <div class="flex space-x-2 items-center">
                            <div
                                class="bg-purple text-white text-xxs font-bold uppercase leading-none text-center w-28 rounded-full h-7 py-2 px-4">
                                Considering
                            </div>

                            <button
                                class="relative bg-gray-200 hover:bg-gray-300 rounded-full h-7 px-2 transition duration-300 ease-in ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                                </svg>
                                <ul class="absolute p-0 w-44 font-semibold text-sm shadow-lg  bg-white overflow-hidden text-left left-5 rounded-xl ">
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
    </div> <!--end ideas-container -->
</x-app-layout>
