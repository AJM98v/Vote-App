<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;

class IdeaIndex extends Component
{
    public $idea;
    public $votes;

    public function mount(Idea $idea){
        $this->idea = $idea;
        $this->votes = $idea->votes_count;
    }



    public function render()
    {
        return view('livewire.idea-index');
    }
}
