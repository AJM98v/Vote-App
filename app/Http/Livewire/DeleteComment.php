<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class DeleteComment extends Component
{
    public $comment;

    protected $listeners = ['setDeleteComment'];

    public function setDeleteComment(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function deleteComment()
    {
        if (auth()->guest() or auth()->user()->cannot('delete',$this->comment))
        {
            abort('403',"You Can Delete this Comment");
        }
        $this->comment->delete();
        $this->dispatchBrowserEvent('close-modal');
        $this->emit('deletedComment');
    }

    public function render()
    {
        return view('livewire.delete-comment');
    }
}
