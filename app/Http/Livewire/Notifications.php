<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    public $notifications;

    protected $listeners = ['getNotifications'];

    public function getNotifications()
    {
        $this->notifications = auth()->user()->unreadNotifications;
    }

    public function mount()
    {
        $this->notifications = collect([]);
    }
    public function render()
    {
        return view('livewire.notifications');
    }
}
