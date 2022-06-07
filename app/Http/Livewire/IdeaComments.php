<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;

class IdeaComments extends Component
{

    public $idea;
    public $comments ;


    public function mount(Idea $idea )
    {
        $this->idea = $idea;
        $this->comments = $idea->comments;


    }



    public function render()
    {
        return view('livewire.idea-comments', [
            'comments'=> $this->comments
        ]);
    }
}
