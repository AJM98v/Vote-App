<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;

class DeleteIdea extends Component
{
    public $idea;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function deleteIdea()
    {

        if (auth()->check()) {
            if (auth()->user()->cannot("delete", $this->idea)) {
                abort('403');
            }
        } else {
            abort('403', "You are Not Logged in");
        }

        $this->idea->delete();
        return redirect(route('index'))->with('message', 'This Idea Deleted Successfully');


    }

    public function render()
    {
        return view('livewire.delete-idea');
    }
}

