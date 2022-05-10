<nav class=" justify-between items-center text-xs hidden md:flex">
    <ul class="uppercase font-semibold space-x-10 border-b-4 pb-3 flex">
        <li><a wire:click.prevent="setStatus('All')" href=""
               class=@if($status !== 'All') "text-gray-400 transition duration-200 ease-in border-b-4 pb-3 hover:border-b-blue hover:text-black"@else
                "border-b-blue border-b-4 pb-3"
            @endif>All Ideas (87)</a></li>
        <li><a wire:click.prevent="setStatus('Considering')" href=""
               class=@if($status !== 'Considering') "text-gray-400 transition duration-200 ease-in border-b-4 pb-3 hover:border-b-blue hover:text-black"@else
                "border-b-blue border-b-4 pb-3"
            @endif>Considering
                (6)</a></li>
        <li><a wire:click.prevent="setStatus('In Progress')" href=""
               class=@if($status !== 'In Progress') "text-gray-400 transition duration-200 ease-in border-b-4 pb-3 hover:border-b-blue hover:text-black"@else
                "border-b-blue border-b-4 pb-3"
            @endif>In
                Process (1)</a></li>

    </ul>
    <ul class="uppercase font-semibold space-x-10 border-b-4 pb-3 flex ml-20">
        <li><a wire:click.prevent="setStatus('Implemented')" href=""
               class=@if($status !== 'Implemented') "text-gray-400 transition duration-200 ease-in border-b-4 pb-3 hover:border-b-blue hover:text-black"@else
                "border-b-blue border-b-4 pb-3"
            @endif>implemented
                (10)</a></li>
        <li><a wire:click.prevent="setStatus('Closed')" href=""
               class=@if($status !== 'Closed') "text-gray-400 transition duration-200 ease-in border-b-4 pb-3 hover:border-b-blue hover:text-black"@else
                "border-b-blue border-b-4 pb-3"
            @endif>closed
                (55)</a></li>

    </ul>

</nav>

