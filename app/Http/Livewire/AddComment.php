<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Idea;
use Livewire\Component;

class AddComment extends Component
{
    public $idea;
    public $comment;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    protected $rules = [
        'comment' => "required|min:10"
    ];

    public function addComment()
    {
        if (auth()->check()) {
            $this->validate();
            Comment::create([
                "user_id" => auth()->id(),
                'idea_id' => $this->idea->id,
                'body' => $this->comment
            ]);
        }else
        {
            abort("403","You are Not Logged in");
        }

        $this->dispatchBrowserEvent("close-comment");
        $this->reset('comment');

        session()->flash('message', "comment posted");
        $this->redirect(route('idea',$this->idea));
    }

    public function render()
    {
        return view('livewire.add-comment');
    }
}
