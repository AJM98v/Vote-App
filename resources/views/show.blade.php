<x-app-layout>
    <x-slot name="title">
        {{$idea->title}} | Vote App
    </x-slot>
    <div>
        <a href="{{$backUrl}}" class="flex items-center font-semibold hover:underline">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            <span class="ml-2">All Ideas</span>
        </a>
    </div>

    @livewire('idea-show',['idea'=>$idea])

    @can('update', $idea)
        @livewire("edit-idea",['idea'=>$idea])
    @endcan

    @can('delete',$idea)
        @livewire('delete-idea' , ['idea'=>$idea])
    @endcan

    @livewire('mark-spam',['idea'=>$idea])


    @livewire('idea-comments', ['idea'=>$idea])


</x-app-layout>
