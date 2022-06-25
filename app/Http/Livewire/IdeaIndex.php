<?php

namespace App\Http\Livewire;

use App\Exceptions\VoteDuplicateExption;
use App\Exceptions\VoteNotFOundExption;
use App\Models\Idea;
use Livewire\Component;

class IdeaIndex extends Component
{
    public $idea;
    public $votes;
    public $hasVoted;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        $this->votes = $idea->votes_count;
        $this->hasVoted = $idea->isVotedByUser(auth()->user());
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function vote()
    {
        if (!auth()->check()) {
            redirect()->setIntendedUrl(url()->previous());

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
        return view('livewire.idea-index');
    }
}
