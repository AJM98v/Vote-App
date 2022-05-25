@component('mail::message')
# Idea Status Updated

The Idea :{{$idea->title}} status Change to: <div class="text-red font-bold"> {{$idea->status->name}}</div>

@component('mail::button', ['url' => route('idea',$idea)])
View Idea
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
