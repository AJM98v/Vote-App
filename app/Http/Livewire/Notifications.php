<?php

namespace App\Http\Livewire;

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
        $this->isLoading =false;
    }

    public function mount()
    {
        $this->notifications = collect([]);
        $this->count = auth()->user()->unreadNotifications->count();
        $this->isLoading = true;
    }
    public function render()
    {
        return view('livewire.notifications');
    }
}
