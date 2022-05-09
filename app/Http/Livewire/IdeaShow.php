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


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function vote()
    {
        if (!auth()->check()) {
            return redirect(route('login'));
        }

        if ($this->hasVoted){
            $this->idea->removeVote(auth()->user());
            $this->votes --;
            $this->hasVoted = false;
        }else{
            $this->idea->vote(auth()->user());
            $this->votes ++;
            $this->hasVoted = true;
        }
    }

    public function render()
    {
        return view('livewire.idea-show');
    }
}
