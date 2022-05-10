<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;
use Livewire\WithPagination;

class IdeasIndex extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.ideas-index',[
            'ideas'=> Idea::with('category', 'user', 'status')
//            ->addSelect(['votedByUser'=>Vote::where('user_id',auth()->user())->whereColumn('idea_id','ideas.id')->select('id')])
                ->withCount('votes')
                ->orderByDesc('id')
                ->paginate('5')
        ]);
    }
}
