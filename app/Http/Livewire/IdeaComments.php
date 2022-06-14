<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Idea;
use Livewire\Component;
use Livewire\WithPagination;

class IdeaComments extends Component
{


    public $idea;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;

    }

    protected  $listeners = ['deletedComment'];

    public function deletedComment(){
        return redirect()->route('idea',$this->idea)->with('message', 'comment Deleted Successfully');
    }


    public function render()
    {
        return view('livewire.idea-comments', [
            'comments' => Comment::with("user")->where("idea_id", $this->idea->id)->paginate("10")->withQueryString()
        ]);
    }
}
