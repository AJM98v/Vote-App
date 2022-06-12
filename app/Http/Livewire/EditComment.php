<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class EditComment extends Component
{
    public $comment;
    public $commentText;

    protected $listeners = ["setEditComment"];

    protected $rules = [
        'commentText' => "required|min:10"
    ];

    public function setEditComment(Comment $comment)
    {
        $this->comment = $comment;
        $this->commentText = $comment->body;
    }

    public function editComment()
    {
        if (auth()->guest() || auth()->user()->cannot('update', $this->comment)) {
            abort('403', "You are Not Access To This Comment");

        } else {
            $this->validate();
            $this->comment->update(['body' => $this->commentText]);

            $this->emit('updateComment');
            $this->dispatchBrowserEvent("close-comment-modal");
        }


    }


    public function render()
    {
        return view('livewire.edit-comment');
    }
}
