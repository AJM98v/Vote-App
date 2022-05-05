<div>
    <form wire:submit.prevent='createIdea' " method=" post" class="p-4 space-y-4">
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
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category')
                <p class="mt-2 text-xs text-red">{{ $message }}</p>
            @enderror
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
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600 -rotate-45" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg>
                <span class="ml-2">Attach</span>
            </button>
            <button
                class="flex items-center justify-center w-1/2 px-6 py-3 text-sm font-semibold text-white transition duration-200 ease-in h-11 bg-blue rounded-xl hover:bg-blue-hover"
                type="submit">Submit
            </button>

        </div>
    </form>


    @if (session()->has('message'))
        <div x-data="{
            show: true
        }" x-init="setTimeout(() => { show = false }, 3000)" x-show="show" x-transition.opacity.duration.300ms
            class="fixed px-6 py-2 text-sm text-center text-white bg-teal-900 bottom-5 right-4 rounded-2xl drop-shadow e">
            {{ session('message') }}
        </div>
    @endif


</div>
