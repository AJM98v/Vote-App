<?php

namespace App\Http\Livewire;

use App\Exceptions\VoteDuplicateExption;
use App\Exceptions\VoteNotFOundExption;
use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;

class IdeaShow extends Component
{

    public $idea;
    public $votes;
    public $hasVoted;


    protected $listeners = ['statusUpdateEvent'=>"updateStatus"];


    public function updateStatus()
    {
        $this->idea->refresh();
    }

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

        if ($this->hasVoted) {
            try {
                $this->idea->removeVote(auth()->user());
            } catch (VoteNotFOundExption $e) {
                //do Nothing
            }

            $this->votes--;
            $this->hasVoted = false;
        } else {
            try {
                $this->idea->vote(auth()->user());
            } catch (VoteDuplicateExption $e) {
                //do Nothing
            }

            $this->votes++;
            $this->hasVoted = true;
        }
    }

    public function render()
    {
        return view('livewire.idea-show');
    }
}
