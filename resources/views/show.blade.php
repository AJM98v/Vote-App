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
                <div class="text-gray-600 mt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores
                    corporis, facere ipsum nam odio similique suscipit. Hic nobis praesentium quasi?
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
                            x-data="{
                                   isOpen : false
                            }" @click="isOpen = !isOpen" @click.outside="isOpen = false"
                            @keydown.esc.window="isOpen =false"
                            class="relative bg-gray-200 hover:bg-gray-300 rounded-full h-7 px-2 transition duration-300 ease-in ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                            </svg>
                            <ul
                                x-show="isOpen" x-transition.origin.top.left.duration.200ms x-cloak
                                class="absolute p-0 w-44 font-semibold text-sm shadow-lg  bg-white overflow-hidden text-left left-5 rounded-xl ">
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
            <div class="relative"
                 x-data="{
                         isOpen : false
                        }" @click="isOpen = !isOpen" @click.outside="isOpen = false" @keydown.esc.window="isOpen =false"
            >
                <button
                    class=" flex items-center rounded-xl bg-blue hover:bg-blue-hover px-6 py-3 text-white text-xs h-9 w-32 justify-center transition duration-200 ease-in font-semibold"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4 text-gray-200" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                    </svg>
                    <span>Replay</span>
                </button>
                <div
                    x-show="isOpen" x-transition.origin.top.left.duration.200ms x-cloak
                    class=" absolute z-10 w-[26rem] text-left font-semibold text-sm bg-white rounded-xl px-2 py-2 drop-shadow-lg  mt-2">
                    <form action="#" method="post" class="space-y-4 px-4 py-5">
                        <textarea
                            class="w-full text-sm bg-gray-200 rounded-xl placeholder-gray-900 border-none px-4 py-2"
                            id="post_comment" cols="30" rows="4" name="post_comment"
                            placeholder="Share your thoughts.."></textarea>
                        <div class="flex items-center justify-center space-x-3">
                            <button type="submit"
                                    class="rounded-xl bg-blue hover:bg-blue-hover p-2 text-white text-xs h-9 w-1/2 justify-center transition duration-200 ease-in font-semibold">
                                Post Comment
                            </button>
                            <button
                                class="flex items-center justify-center p-2 w-1/3 h-9 text-xs bg-gray-200 font-semibold rounded-xl border transition duration-200 ease-in border-gray-200 hover:border-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600 -rotate-45"
                                     fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                </svg>
                                <span class="ml-2">Attach</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="relative"
                 x-data="{
                      isOpen : false
                        }"
                 @click="isOpen = !isOpen" @click.outside="isOpen = false" @keydown.esc.window="isOpen =false">
                <button
                    class="flex items-center py-3 px-6 justify-center w-32 h-9 text-xs bg-gray-200 font-semibold rounded-xl border transition duration-200 ease-in border-gray-200 hover:border-gray-400">
                    <span class="mr-2">Set Status</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>

                </button>
                <div
                    class="absolute mt-2 left-0 drop-shadow-lg rounded-xl w-[19rem] z-20 bg-white font-semibold text-left "
                    x-show="isOpen" x-transition.origin.top.duration.200ms x-cloak
                >
                    <form action="#" method="post" class="space-y-4 p-4">

                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input name="status" id="open" value="open" type="radio"
                                       class="focus:ring-black h-4  w-4 text-black bg-gray-300 border-none"/>
                                <label for="open" class="ml-3 block text-sm font-medium text-gray-700"> Open </label>
                            </div>
                            <div class="flex items-center">
                                <input name="status" id="considering" value="considering" type="radio"
                                       class="focus:ring-purple h-4  w-4 text-purple bg-gray-300 border-none"/>
                                <label for="considering" class="ml-3 block text-sm font-medium text-gray-700">
                                    Considering </label>
                            </div>
                            <div class="flex items-center">
                                <input name="status" id="inProgress" value="inProgress" type="radio"
                                       class="focus:ring-yellow h-4  w-4 text-yellow bg-gray-300 border-none"/>
                                <label for="inProgress" class="ml-3 block text-sm font-medium text-gray-700"> In
                                    Progress </label>
                            </div>
                            <div class="flex items-center">
                                <input name="status" id="implemented" value="implemented" type="radio"
                                       class="focus:ring-blue h-4  w-4 text-blue bg-gray-300 border-none"/>
                                <label for="implemented" class="ml-3 block text-sm font-medium text-gray-700">
                                    Implemented </label>
                            </div>
                            <div class="flex items-center">
                                <input name="status" id="close" value="close" type="radio"
                                       class="focus:ring-red h-4  w-4 text-red bg-gray-300 border-none"/>
                                <label for="close" class="ml-3 block text-sm font-medium text-gray-700"> Closed </label>
                            </div>
                        </div>
                        <div>
                             <textarea name="update_comment" id="update_comment" cols="30" rows="3"
                                       class="text-sm bg-gray-200 rounded-xl focus:ring-0 placeholder-gray-700 outline-none  focus:outline-none focus:border-none p-4 border-none w-full "
                                       placeholder="Add a Update Comment(Optional)"></textarea>

                        </div>
                        <div class="flex justify-between items-center space-x-2">
                            <button
                                class="flex items-center p-2 justify-center w-1/2 text-xs bg-gray-200 font-semibold rounded-xl border transition duration-200 ease-in border-gray-200 hover:border-gray-400"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600 -rotate-45"
                                     fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                </svg>
                                <span class="ml-2">Attach</span>
                            </button>
                            <button
                                class="text-white flex items-center p-2 justify-center w-1/2 text-xs bg-blue font-semibold rounded-xl transition duration-200 ease-in  hover:bg-blue-hover"
                                type="submit">Update
                            </button>

                        </div>
                        <div>
                            <input id="notify_voters" name="notify_voters" type="checkbox"
                                   class="focus:ring-0 h-4 w-4 text-gray-600 border-none bg-gray-300 rounded" checked>
                            <label for="notify_voters ml-2 text-sm">Notify Voters</label>
                        </div>


                    </form>

                </div>
            </div>


        </div>
        <div class="flex justify-center items-center space-x-3">
            <div class="bg-white font-semibold text-center rounded-xl px-2 py-2 shadow drop-shadow">
                <div class="text-xl leading-snug text-xs uppercase">12</div>
                <div class="text-gray-400 leading-none text-xs uppercase">Votes</div>
            </div>
            <button
                class="uppercase font-bold py-2 px-6 justify-center w-32 h-9 text-xs bg-gray-200 font-semibold rounded-xl border transition duration-200 ease-in border-gray-200 hover:border-gray-400">
                Vote
            </button>

        </div>

    </div> <!-- end button-container-->


    <div
        class="comments space-y-6 ml-20 my-8 relative before:content-[''] before:absolute before:-left-10 before:top-2 before:w-0.5 before:h-[90%] before:bg-gray-500 before:opacity-70 before:block ">
        <div
            class="comment mt-5 bg-white rounded-xl relative flex before:content-[''] before:absolute before:-left-10 before:top-[50%] before:translate-y-[-50%] before:w-10 before:h-0.5 before:bg-gray-500 before:opacity-70 before:block ">
            <div class="flex flex-1 px-4 py-6 ">
                <a href="#" class="flex-none h-fit">
                    <img src="https://source.unsplash.com/200*200/?face&crop=face&v=1" alt="avatar"
                         class="w-14 h-14 rounded-2xl">
                </a>
                <div class="mx-4 w-full">
                    {{--                    <h4 class="text-xl font-semibold ">--}}
                    {{--                        <a href="#" class="hover:underline">Random title Goes here</a>--}}
                    {{--                    </h4>--}}
                    <div class="text-gray-600 mt-4 line-clamp-3">Lorem ipsum
                    </div>
                    <div class="flex justify-between items-center mt-5">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div class="font-bold text-gray-900">Abolfazl Jafari</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>


                        </div>
                        <div class="flex space-x-2 items-center">

                            <button
                                x-data="{
                                   isOpen : false
                                }" @click="isOpen = !isOpen" @click.outside="isOpen = false"
                                @keydown.esc.window="isOpen =false"
                                class="relative bg-gray-200 hover:bg-gray-300 rounded-full h-7 px-2 transition duration-300 ease-in ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                                </svg>
                                <ul
                                    x-show="isOpen" x-transition.origin.top.left.duration.200ms x-cloak
                                    class=" absolute p-0 w-44 font-semibold text-sm shadow-lg z-20 bg-white overflow-hidden text-left left-5 rounded-xl ">
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

        </div> <!--end comment-container-->
        <div
            class="comment isAdmin mt-5 bg-white border border-blue rounded-xl flex shadow-md before:absolute relative before:content-['']  before:-left-14 before:translate-y-[-50%] before:top-[50%] before:w-8 before:rounded-full before:h-8 before:bg-purple before:border-4 before:border-white before:block">
            <div class="flex flex-1 px-4 py-6 ">
                <div class="flex-none h-fit">
                    <a href="#" class="">
                        <img src="https://source.unsplash.com/200*200/?face&crop=face&v=2" alt="avatar"
                             class="w-14 h-14 rounded-2xl">
                    </a>
                    <h4 class="uppercase text-blue text-xxs text-center font-bold mt-1">Admin</h4>
                </div>


                <div class="mx-4 w-full">
                    <h4 class="text-xl font-semibold ">
                        <a href="#" class="hover:underline">Random title Goes here</a>
                    </h4>
                    <div class="text-gray-600 mt-4 line-clamp-3">Lorem ipsum
                    </div>
                    <div class="flex justify-between items-center mt-5">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div class="font-bold text-blue ">Abolfazl Jafari</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>


                        </div>
                        <div class="flex space-x-2 items-center">

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

        </div> <!--end admin-comment-container-->
        <div
            class="comment mt-5 bg-white rounded-xl  flex">
            <div class="flex flex-1 px-4 py-6 ">
                <a href="#" class="flex-none h-fit">
                    <img src="https://source.unsplash.com/200*200/?face&crop=face&v=1" alt="avatar"
                         class="w-14 h-14 rounded-2xl">
                </a>
                <div class="mx-4 w-full">
                    {{--                    <h4 class="text-xl font-semibold ">--}}
                    {{--                        <a href="#" class="hover:underline">Random title Goes here</a>--}}
                    {{--                    </h4>--}}
                    <div class="text-gray-600 mt-4 line-clamp-3">Lorem ipsum
                    </div>
                    <div class="flex justify-between items-center mt-5">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div class="font-bold text-gray-900">Abolfazl Jafari</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>


                        </div>
                        <div class="flex space-x-2 items-center">

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

        </div> <!--end comment-container-->
        <div
            class="comment mt-5 bg-white rounded-xl  flex relative">
            <div class="flex flex-1 px-4 py-6 ">
                <a href="#" class="flex-none h-fit">
                    <img src="https://source.unsplash.com/200*200/?face&crop=face&v=1" alt="avatar"
                         class="w-14 h-14 rounded-2xl">
                </a>
                <div class="mx-4 w-full">
                    {{--                    <h4 class="text-xl font-semibold ">--}}
                    {{--                        <a href="#" class="hover:underline">Random title Goes here</a>--}}
                    {{--                    </h4>--}}
                    <div class="text-gray-600 mt-4 line-clamp-3">Lorem ipsum
                    </div>
                    <div class="flex justify-between items-center mt-5">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div class="font-bold text-gray-900">Abolfazl Jafari</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>


                        </div>
                        <div class="flex space-x-2 items-center">

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

        </div> <!--end comment-container-->


    </div> <!-- end comments-container-->


</x-app-layout>
