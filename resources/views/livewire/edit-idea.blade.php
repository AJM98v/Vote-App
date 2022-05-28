<div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!--
      Background backdrop, show/hide based on modal state.

      Entering: "ease-out duration-300"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-full p-4 text-center sm:p-0">
            <!--
              Modal panel, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                To: "opacity-100 translate-y-0 sm:scale-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 sm:scale-100"
                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            -->
            <div
                class="relative bg-white rounded-t-xl text-left overflow-hidden shadow-xl transform transition-all  sm:max-w-lg sm:w-full">
                <div class="absolute top-3 right-3 text-gray-400 hover:text-red transition-all ease-in duration-300 cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg></div>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-center text-lg font-medium text-gray-800">Edit Idea</h3>
                    <p class="text-xxs text-center text-gray-500 my-3 leading-5 px-2">You Have One Hour to Edit Your Idea After
                        Creating it </p>
                    <form wire:submit.prevent='EditIdea()' method="post" class="p-4 space-y-4">
                        <div>
                            <input type="text" name="title" wire:model.defer='title'
                                   class="w-full px-4 py-2 text-sm placeholder-gray-900 bg-gray-100 border-none rounded-xl"
                                   placeholder="Your Idea">

                            @error('title')
                            <p class="mt-2 text-xs text-red">{{ $message }}</p>
                            @enderror

                        </div>
                        <div>
                            <select name="category_add" id="category_add" wire:model.defer='category'
                                    class="w-full px-4 py-2 text-sm placeholder-gray-900 bg-gray-100 border-none rounded-xl">
                                {{--                                @foreach ($categories as $category)--}}
                                {{--                                    <option value="{{ $category->id }}">{{ $category->name }}</option>--}}
                                {{--                                @endforeach--}}
                            </select>
                            {{--                            @error('category')--}}
                            {{--                            <p class="mt-2 text-xs text-red">{{ $message }}</p>--}}
                            {{--                            @enderror--}}
                        </div>
                        <div>
            <textarea name="idea" id="idea" wire:model.defer='description'
                      class="w-full px-4 py-2 placeholder-gray-900 bg-gray-100 border-none rounded-xl"
                      placeholder="Describe Your Idea" cols="30" rows="4"></textarea>
                            @error('description')
                            <p class="mt-2 text-xs text-red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between space-x-2">
                            <button
                                class="flex items-center justify-center w-1/2 px-6 py-3 text-sm font-semibold transition duration-200 ease-in bg-gray-200 border border-gray-200 h-11 rounded-xl hover:border-gray-400"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600 -rotate-45"
                                     fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                </svg>
                                <span class="ml-2">Attach</span>
                            </button>
                            <button
                                class="flex items-center justify-center w-1/2 px-6 py-3 text-sm font-semibold text-white transition duration-200 ease-in h-11 bg-blue rounded-xl hover:bg-blue-hover"
                                type="submit">Submit
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
