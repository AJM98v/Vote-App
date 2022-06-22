@component('mail::message')
# A Comment Was Posted On Your Idea

{{$comment->user->name}} Commented on your Idea :

** {{$comment->idea->title}} **

Comment : {{ $comment->body }}

@component('mail::button', ['url' => route('idea' ,$comment->idea)])
Go to Idea
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
