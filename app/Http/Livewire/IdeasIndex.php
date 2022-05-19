<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;

class IdeasIndex extends Component
{

    public $status;
    public $category;
    protected $queryString = ['status', 'category'];


    protected $listeners = ['queryStringStatus'];

    public function queryStringStatus($status)
    {
        $this->status = $status;

    }

    public function mount()
    {
        $this->category = request()->category ?? "All";
        $this->status = request()->status ?? "All";
    }

    public function updatedCategory($category)
    {
        $this->category = $category;
        return redirect()->route('index', [
            'status' => $this->status,
            'category' => $this->category
        ]);
    }


    public function render()
    {
        $statuses = Status::all()->pluck('id', 'name');
        $categories = Category::all();


        return view('livewire.ideas-index', [
            'ideas' => Idea::with('category', 'user', 'status')
//            ->addSelect(['votedByUser'=>Vote::where('user_id',auth()->user())->whereColumn('idea_id','ideas.id')->select('id')])
                ->when($this->status && $this->status !== 'All', function ($query) use ($statuses) {
                    return $query->where('status_id', $statuses->get($this->status));
                })->when(request()->category && request()->category !== "All", function ($query) use ($categories) {
                    return $query->where('category_id', $categories->pluck('id', 'name')->get(request()->category));
                })
                ->withCount('votes')
                ->orderByDesc('id')
                ->paginate('5'),
            'categories' => $categories
        ]);
    }
}
