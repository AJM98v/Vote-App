<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;

class IdeaShow extends Component
{

    public $idea;
    public $votes;
    public $hasVoted;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        $this->votes = $idea->votes()->count();
        $this->hasVoted = $idea->isVotedByUser(auth()->user());
    }

    public function render()
    {
        return view('livewire.idea-show');
    }
}
