<div
    x-data="{
                }"
    @click="
                const target = $event.target.tagName.toLowerCase()

                const ignore = ['button','svg','path','a']

                if (!ignore.includes(target)){
                    $event.target.closest('.idea-container').querySelector('.idea-link').click()
                }
                "
    class="idea-container bg-white rounded-xl cursor-pointer flex hover:shadow-card transition duration-200 ease-in">
    <div class="border-r border-gray-200 px-5 py-8 hidden md:block">
        <div class="text-center">
            <div class="font-semibold text-2xl  @if($hasVoted) text-blue @endif">{{$votes}}</div>
            <div class="text-gray-500">Votes</div>

        </div>
        <div class="mt-8">
            @if($hasVoted)
            <button wire:click.prevent="vote"
                class="w-20 bg-blue text-white font-bold text-xxs uppercase rounded-xl px-4 py-3 transition duration-300 ease-in border border-blue hover:border-blue-hover hover:bg-blue-hover">
                Voted
            </button>
            @else
                <button wire:click.prevent="vote"
                        class="w-20 bg-gray-400 text-white font-bold text-xxs uppercase rounded-xl px-4 py-3 transition duration-300 ease-in border border-gray-400 hover:border-gray-600 hover:bg-gray-600">
                    Vote
                </button>
            @endif

        </div>

    </div>
    <div class="flex flex-1 px-2 py-6 flex-col  md:flex-row">
        <a href="#" class="flex-none h-fit m-3 md:m-0">
            <img src="{{$idea->user->getAvatar()}}" alt="avatar"
                 class="w-14 h-14 rounded-2xl">
        </a>
        <div class="px-4 w-full flex flex-col justify-between">
            <h4 class="text-xl font-semibold ">
                <a href="{{route('idea', $idea)}}" class="idea-link hover:underline">{{$idea->title}}</a>
            </h4>
            <div class="text-gray-600 mt-4 line-clamp-3 px-4 md:px-2">Lorem ipsum dolor sit amet,
                {{$idea->description}}
            </div>
            <div
                class="flex justify-between md:items-center mt-5 flex-col md:flex-row space-y-4 md:space-y-0 ">
                <div
                    class="flex items-center w-fit space-x-2  md:w-2/3  text-xs text-gray-400 font-semibold  md:space-x-2 justify-between  md:justify-start">
                    <div>{{$idea->created_at->diffForHumans()}}</div>
                    <div>&bull;</div>
                    <div>{{$idea->category->name}}</div>
                    <div>&bull;</div>
                    <div class="text-gray-800">3 comment</div>
                    <div>&bull;</div>

                </div>
                <div class="flex justify-between items-center px-4">
                    <div class="md:hidden flex items-center">
                        <div class="bg-gray-200  text-center text-xxs rounded-l-2xl h-10 px-4 py-2">
                            <div class="font-bold leading-none text-xs @if($hasVoted) text-blue @endif">{{$votes}}</div>
                            <div class="font-bold uppercase text-gray-600 ">Votes</div>
                        </div>
                        @if($hasVoted)
                            <button wire:click.prevent="vote"
                                class="bg-blue font-bold text-white px-3 py-2 h-10 rounded-2xl  uppercase hover:bg-blue-hover transition duration-300 ease-in hover:border-blue border -mx-3 ">
                                Voted
                            </button>
                        @else
                            <button  wire:click.prevent="vote"
                                class="px-3 py-2 h-10 rounded-2xl  uppercase hover:bg-gray-600 transition duration-300 ease-in hover:border-gray-300 border hover:text-white -mx-3 font-bold bg-gray-400 ">
                                Vote
                            </button>
                        @endif
                    </div>
                    <div class="flex space-x-2 items-center">
                        <div
                            style="background-color: {{$idea->status->color}}"
                            class="text-white text-xxs font-bold uppercase leading-none text-center w-28 rounded-full h-7 py-2 px-4">
                            {{$idea->status->name}}
                        </div>

                        <button x-data="{
                            isOpen : false
                            }" @click="isOpen = !isOpen" @keydown.esc.window="isOpen =false"
                                class="relative bg-gray-200 hover:bg-gray-300 rounded-full h-7 px-2 transition duration-300 ease-in ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500"
                                 fill="none"
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
