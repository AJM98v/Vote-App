<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class IdeaComment extends Component
{
    public $comment;
    public $ideaUserId;

    protected  $listeners=['updateComment'];

    public function updateComment()
    {
        $this->comment->refresh();
    }

    public function resetSpam()
    {
        $this->comment->spam_report = 0 ;
        $this->comment->save();

        $this->dispatchBrowserEvent('close-modal');

    }

    public function mount(Comment $comment,$ideaUserId){
        $this->comment = $comment;
        $this->ideaUserId = $ideaUserId;
    }
    public function render()
    {
        return view('livewire.idea-comment');
    }
}
