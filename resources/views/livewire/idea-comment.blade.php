@if($comment->user->isAdmin())
            <div
                class="comment isAdmin ml-3 md:ml-0 mt-5 bg-white border border-blue rounded-xl flex shadow-md md:before:absolute relative md:before:content-['']  md:before:-left-14 md:before:translate-y-[-50%] md:before:top-[50%] md:before:w-8 md:before:rounded-full md:before:h-8 md:before:bg-purple md:before:border-4 md:before:border-white md:before:block">
                <div class="flex flex-1 px-4 py-6 ">
                    <div class="flex-none h-fit">
                        <a href="#" class="">
                            <img src="{{$comment->user->getAvatar()}}" alt="avatar"
                                 class="w-14 h-14 rounded-2xl">
                        </a>
                        <h4 class="uppercase text-blue text-xxs text-center font-bold mt-1">Admin</h4>
                    </div>


                    <div class="mx-4 w-full">
                        <h4 class="text-xl font-semibold ">
                            <a href="#" class="hover:underline">Random title Goes here</a>
                        </h4>
                        <div class="text-gray-600 mt-4 line-clamp-3">{{$comment->body}}
                        </div>
                        <div class="flex justify-between items-center mt-5">
                            <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                                <div class="font-bold text-blue ">{{$comment->user->name}}</div>
                                <div>&bull;</div>
                                <div>{{$comment->created_at->diffForHumans()}}</div>



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
@else
    <div
        class="comment mt-5 bg-white rounded-xl  flex">
        <div class="flex flex-1 px-4 py-6 ">
            <a href="#" class="flex-none h-fit">
                <img src="{{$comment->user->getAvatar()}}" alt="avatar"
                     class="w-14 h-14 rounded-2xl">
            </a>
            <div class="mx-4 w-full">
                {{--                    <h4 class="text-xl font-semibold ">--}}
                {{--                        <a href="#" class="hover:underline">Random title Goes here</a>--}}
                {{--                    </h4>--}}
                <div class="text-gray-600 mt-4 line-clamp-3">{{$comment->body}}
                </div>
                <div class="flex justify-between items-center mt-5">
                    <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                        <div class="font-bold text-gray-900">{{$comment->user->name}}</div>
                        <div>&bull;</div>
                        <div>{{$comment->created_at->diffForHumans()}}</div>


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
@endif
