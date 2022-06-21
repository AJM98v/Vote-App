<div class="relative"
     x-data="{
                      isOpen : false
                        }"
     @keydown.esc.window="isOpen =false"
     @close-status.window="isOpen = false"
>
    <button
        @click="isOpen = !isOpen"
        class="flex items-center py-3 px-6 justify-center w-32 h-9 text-xs bg-gray-200 font-semibold rounded-xl border transition duration-200 ease-in border-gray-200 hover:border-gray-400">
        <span class="mr-2">Set Status</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
             stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
        </svg>

    </button>
    <div
        class="absolute mt-2 md:left-0 drop-shadow-lg rounded-xl w-[15rem] right-0 z-20 bg-white font-semibold text-left "
        x-show="isOpen" x-transition.origin.top.duration.200ms x-cloak @click.outside="isOpen = false">
        <form wire:submit.prevent="setStatus()" method="post" class="space-y-4 p-4">

            <div class="space-y-2">
                <div class="flex items-center">
                    <input name="status" wire:model="status" id="open" value="1" type="radio"
                           class="focus:ring-black h-4  w-4 text-black bg-gray-300 border-none"/>
                    <label for="open" class="ml-3 block text-sm font-medium text-gray-700"> Open </label>
                </div>
                <div class="flex items-center">
                    <input name="status" wire:model="status" id="considering" value="3" type="radio"
                           class="focus:ring-purple h-4  w-4 text-purple bg-gray-300 border-none"/>
                    <label for="considering" class="ml-3 block text-sm font-medium text-gray-700">
                        Considering </label>
                </div>
                <div class="flex items-center">
                    <input name="status" wire:model="status" id="inProgress" value="4" type="radio"
                           class="focus:ring-yellow h-4  w-4 text-yellow bg-gray-300 border-none"/>
                    <label for="inProgress" class="ml-3 block text-sm font-medium text-gray-700"> In
                        Progress </label>
                </div>
                <div class="flex items-center">
                    <input name="status" wire:model="status" id="implemented" value="5" type="radio"
                           class="focus:ring-blue h-4  w-4 text-blue bg-gray-300 border-none"/>
                    <label for="implemented" class="ml-3 block text-sm font-medium text-gray-700">
                        Implemented </label>
                </div>
                <div class="flex items-center">
                    <input name="status" wire:model="status" id="close" value="2" type="radio"
                           class="focus:ring-red h-4  w-4 text-red bg-gray-300 border-none"/>
                    <label for="close" class="ml-3 block text-sm font-medium text-gray-700"> Closed </label>
                </div>
            </div>
            <div>
                             <textarea wire:model="body" name="update_comment" id="update_comment" cols="30" rows="3"
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
                    class="disabled:opacity-50 text-white flex items-center p-2 justify-center w-1/2 text-xs bg-blue font-semibold rounded-xl transition duration-200 ease-in  hover:bg-blue-hover"
                    type="submit">Update
                </button>

            </div>
            <div>
                <input id="notify_voters" wire:model="notify" name="notify_voters" type="checkbox"
                       class="focus:ring-0 h-4 w-4 text-gray-600 border-none bg-gray-300 rounded" >
                <label for="notify_voters ml-2 text-sm">Notify Voters</label>
            </div>

        </form>

    </div>
</div>
