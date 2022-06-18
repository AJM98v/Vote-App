<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class SpamReportComments extends Component
{
    public $comment;

    protected $listeners = ['setSpamComment'];

    public function setSpamComment(Comment $comment)
    {
        $this->comment = $comment;
    }


    public function Report()
    {
        $this->comment->spam_report++;
        $this->comment->save();

        $this->dispatchBrowserEvent('close-spam-comment-modal');


    }
    public function render()
    {
        return view('livewire.spam-report-comments');
    }
}
