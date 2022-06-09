<div class="relative" x-data="{
    isOpen: false
}" @keydown.esc.window="isOpen =false"
    @close-comment.window="isOpen =false" @click.outside="isOpen = false">
    <button @click="
        isOpen = !isOpen
        if(isOpen){
            $nextTick(()=> $refs.comment.focus())
        }

    "
        class="flex items-center justify-center w-32 px-6 py-3 text-xs font-semibold text-white transition duration-200 ease-in rounded-xl bg-blue hover:bg-blue-hover h-9">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-200" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
        </svg>
        <span>Replay</span>
    </button>
    <div x-show="isOpen" x-transition.origin.top.left.duration.200ms x-cloak
        class=" absolute z-10 w-[20rem] text-left font-semibold text-sm bg-white rounded-xl px-2 py-2 drop-shadow-lg -left-4 md:left-0 mt-2">
        @auth
            <form method="post" class="px-4 py-5 space-y-4" wire:submit.prevent="addComment()">
                <textarea wire:model="comment" x-ref="comment"
                    class="w-full px-4 py-2 text-sm placeholder-gray-900 bg-gray-200 border-none rounded-xl" id="post_comment" cols="30"
                    rows="4" name="post_comment" placeholder="Share your thoughts.."></textarea>
                @error('comment')
                    <span class="font-light text-red text-xxs">{{ $message }}</span>
                @enderror
                <div class="flex items-center justify-center space-x-3">
                    <button type="submit"
                        class="justify-center w-1/2 p-2 text-xs font-semibold text-white transition duration-200 ease-in rounded-xl bg-blue hover:bg-blue-hover h-9">
                        Post Comment
                    </button>
                    <button
                        class="flex items-center justify-center w-1/3 p-2 text-xs font-semibold transition duration-200 ease-in bg-gray-200 border border-gray-200 h-9 rounded-xl hover:border-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600 -rotate-45" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                        </svg>
                        <span class="ml-2">Attach</span>
                    </button>
                </div>
            </form>
        @else
            <div class="flex flex-col items-center justify-center px-4 py-6 space-y-3">
                <h5>For Replay you must have Register</h5>
                <div class="mx-auto ">
                    <a href="{{ route('login') }}"
                        class="px-5 py-2 text-white transition-all duration-200 ease-in shadow-md rounded-xl drop-shadow bg-blue hover:bg-blue-hover">Login</a>
                    <a href="{{ route('register') }}"
                        class="px-5 py-2 text-white transition-all duration-200 ease-in shadow-md rounded-xl drop-shadow bg-blue hover:bg-blue-hover">Register</a>
                </div>
            </div>
        @endauth
    </div>
</div>
