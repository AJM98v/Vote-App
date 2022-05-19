<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class StatusFilters extends Component
{

    public $status;
    public $count;


    /**
     * @param $status
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function setStatus($status)
    {
        $this->status = $status;
        $this->emit('queryStringStatus', $this->status);
//        if ($this->getPreviousRouteName() === 'idea') {
            return redirect()->route('index', [
                'status' => $this->status,
            ]);
//        }
    }


    /**
     * @return string|null
     */
    private function getPreviousRouteName(): string|null
    {
        return app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
    }

    public function mount()
    {
        $this->count = Status::getCount();
        $this->status = request()->status ?? "All";

        if (URL::current() !== URL::route('index')) {
            $this->status = null;

        }
    }


    public function render()
    {
        return view('livewire.status-filters');
    }
}
