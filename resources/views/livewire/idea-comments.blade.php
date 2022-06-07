<div
    class="comments space-y-6 md:ml-20  my-8 relative md:before:content-[''] md:before:absolute md:before:-left-10 md:before:top-2
    md:before:w-0.5 md:before:h-[90%] md:before:bg-gray-500 md:before:opacity-70 md:before:block ">

    @foreach($comments as $comment)
        @livewire('idea-comment',['comment'=>$comment ,"ideaUserId"=>$idea->user_id])
    @endforeach

</div> <!-- end comments-container-->
