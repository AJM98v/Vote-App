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
    public $filter;
    public $search;

    protected $queryString = ['status', 'category', 'filter' ,'search'];


    protected $listeners = ['queryStringStatus'];

    public function queryStringStatus($status)
    {
        $this->status = $status;

    }

    public function mount()
    {
        $this->category = request()->category ?? "All";
        $this->status = request()->status ?? "All";
        $this->filter = request()->filter ?? "No Filter";
    }

    public function updatedCategory($category)
    {
        $this->category = $category;
        return redirect()->route('index', [
            'status' => $this->status,
            'category' => $this->category
        ]);
    }

    public function updatedFilter($filter)
    {
        $this->filter = $filter;
        return redirect()->route('index', [
            'status' => $this->status,
            'category' => $this->category,
            'filter' => $this->filter
        ]);
    }

    public function updatedSearch($search)
    {
        $this->search = $search;
        return redirect()->route('index', [
            'status' => $this->status,
            'category' => $this->category,
            'filter' => $this->filter,
            'search'=>$this->search
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
                })->when($this->filter === "Top Voted", function ($query) {
                    return $query->orderByDesc('votes_count');
                })->when(auth()->user() && $this->filter === "My Ideas", function ($query) {
                    return $query->where("user_id", auth()->user()->id);
                })->when($this->search && strlen($this->search) >= 3 , function ($query){
                    return $query->where("title",'like',"%".$this->search."%");
                })
                ->withCount('votes')
                ->orderByDesc('id')
                ->paginate('5'),
            'categories' => $categories,
        ]);
    }
}
