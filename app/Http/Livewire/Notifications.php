<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Notifications\DatabaseNotification;
use Livewire\Component;

class Notifications extends Component
{
    public $notifications;
    public $count;
    public $isLoading;

    protected $listeners = ['getNotifications'];

    public function getNotifications()
    {
        sleep(2);
        $this->notifications = auth()->user()->unreadNotifications;
        $this->isLoading = false;
    }

    public function mount()
    {
        $this->notifications = collect([]);
        $this->count = auth()->user()->unreadNotifications->count();
        $this->isLoading = true;
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $this->getNotifications();
        $this->count = 0;
    }


    public function markAsRead($notificationId)
    {
        $notification = DatabaseNotification::findOrFail($notificationId);
        $notification->markAsRead();

        $comment = Comment::find($notification->data['comment_id']);

        if (! $comment){
            return redirect()->route('index')->with('message', "this comment no longer exists");
        }

        return redirect()->route('idea', [
            'idea'=>$notification->data['idea_slug']
        ]);

    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
