<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;

class IdeasIndex extends Component
{

    public function render()
    {
        $statuses = Status::all()->pluck('id','name');


        return view('livewire.ideas-index',[
            'ideas'=> Idea::with('category', 'user', 'status')
//            ->addSelect(['votedByUser'=>Vote::where('user_id',auth()->user())->whereColumn('idea_id','ideas.id')->select('id')])
                ->when(request()->status && request()->status !== 'All' , function ($query) use ($statuses){
                    return $query->where('status_id',$statuses->get(request()->status));
                })
                ->withCount('votes')
                ->orderByDesc('id')
                ->paginate('5')
        ]);
    }
}
