<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Idea;
use App\Notifications\CommentAdded;
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
            $newComment = Comment::create([
                "user_id" => auth()->id(),
                'idea_id' => $this->idea->id,
                'status_id' => 1,
                'body' => $this->comment
            ]);
        } else {
            abort("403", "You are Not Logged in");
        }

        $this->dispatchBrowserEvent("close-comment");
        $this->reset('comment');

        session()->flash('message', "comment posted");
        $this->redirect(route('idea', $this->idea));


        $this->idea->user->notify(new CommentAdded($newComment));

    }

    public function redirectToLogin()
    {
        redirect()->setIntendedUrl(url()->previous());

        return redirect()->route('login');
    }

    public function redirectToRegister()
    {
        redirect()->setIntendedUrl(url()->previous());

        return redirect()->route('register');
    }

    public function render()
    {
        return view('livewire.add-comment');
    }
}
