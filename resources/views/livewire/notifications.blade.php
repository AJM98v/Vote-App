<div class="relative"
     x-data="{
                            isOpen : false
                            }" @keydown.esc.window="isOpen =false">
    <button class="relative"
            @click="isOpen = !isOpen
            window.livewire.emit('getNotifications')
            "

    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        @if($count !== 0)
        <span
            class="absolute bg-red text-white rounded-full px-2 text-xxs -top-3 -right-3 shadow-sm shadow-gray-500">{{$count}}</span>
        @endif
    </button>

    <ul @click.outside="isOpen = false"
        x-show="isOpen" x-transition.origin.top.left.duration.200ms x-cloak
        class="md:max-h-96 max-h-72 overflow-y-auto absolute p-0 md:w-72 w-64 font-light text-xs shadow-lg   bg-white overflow-hidden text-left md:-right-1  -right-28 mt-1 md:mt-2 rounded-xl  z-20">
        @if($count !== 0 &&  !$isLoading)
      @foreach($notifications as $notification)
        <li class=" px-5 py-2 cursor-pointer hover:bg-gray-100 transition-all ease-in duration-300">
           <a href="{{route('idea', $notification->data['idea_slug'])}}" class="flex">
               <img src="{{$notification->data['user_avatar']}}" alt="avatar" class="rounded-xl w-10 h-10">
               <div class="ml-4">
                   <div class="text-gray-800 line-clamp-5">
                       <p><span class="text-black font-bold">{{$notification->data['user_name']}}</span> Commented
                           On <span class="text-black font-bold">{{$notification->data['idea_title']}}</span> : <span
                               class="font-bold  text-black text-xxs">"{{$notification->data['comment_body']}}"</span>
                       </p>
                   </div>
                   <span class="text-xxs text-gray-500 mt-2">{{$notification->created_at->diffForHumans()}}</span>
               </div>
           </a>

        </li>
        @endforeach

        <li class="border-t border-gray-600 hover:text-white hover:bg-gray-600 flex space-x-2 items-center justify-center text-sm w-full py-2  cursor-pointer transition-all ease-in duration-300">
            <button >Mark All As Read</button>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </li>
        @elseif($isLoading)
            @foreach(range(1,3) as $item)
            <li class="animate-pulse flex items-center transition-all duration-300 ease-in px-4 py-3">
                <div class="bg-gray-200 rounded-xl w-10 h-10"></div>
                <div class="ml-3 space-y-2 flex-1">
                    <div class="bg-gray-200 w-full rounded h-3"></div>
                    <div class="bg-gray-200 w-full rounded h-3"></div>
                    <div class="bg-gray-200 w-20 rounded h-3"></div>
                </div>
            </li>
            @endforeach
        @else
            <div class="text-center font-bold text-gray-600 py-2">You have No Notifications</div>
        @endif
    </ul>

</div>
