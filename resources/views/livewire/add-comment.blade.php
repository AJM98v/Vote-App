<div class="relative"
     x-data="{
                         isOpen : false
                        }"
     @keydown.esc.window="isOpen =false"
     @close-comment.window="isOpen =false"
     @click.outside="isOpen = false">
    <button
        @click="isOpen = !isOpen"
        class=" flex items-center rounded-xl bg-blue hover:bg-blue-hover px-6 py-3 text-white text-xs h-9 w-32 justify-center transition duration-200 ease-in font-semibold">
        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4 text-gray-200" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
        </svg>
        <span>Replay</span>
    </button>
    <div
        x-show="isOpen" x-transition.origin.top.left.duration.200ms x-cloak
        class=" absolute z-10 w-[20rem] text-left font-semibold text-sm bg-white rounded-xl px-2 py-2 drop-shadow-lg -left-4 md:left-0 mt-2">
        @auth
            <form method="post" class="space-y-4 px-4 py-5" wire:submit.prevent="addComment()">
                        <textarea wire:model="comment"
                                  class="w-full text-sm bg-gray-200 rounded-xl placeholder-gray-900 border-none px-4 py-2"
                                  id="post_comment" cols="30" rows="4" name="post_comment"
                                  placeholder="Share your thoughts.."></textarea>
                @error("comment")
                <span class="text-red font-light text-xxs">{{$message}}</span>
                @enderror
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
        @else
            <div class="px-4 space-y-3 py-6 flex flex-col justify-center items-center">
                <h5>For Replay you must have Register</h5>
                <div class="mx-auto ">
                    <a href="{{route('login')}}" class="text-white rounded-xl shadow-md drop-shadow  px-5 py-2 bg-blue hover:bg-blue-hover transition-all ease-in duration-200">Login</a>
                    <a href="{{route('register')}}"  class="text-white rounded-xl shadow-md drop-shadow  px-5 py-2 bg-blue hover:bg-blue-hover transition-all ease-in duration-200">Register</a>
                </div>
            </div>
        @endauth
    </div>
</div>
