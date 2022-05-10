<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\URL;
use Livewire\Component;

class StatusFilters extends Component
{
    public $status = 'All';

    protected $queryString = ['status'];


    /**
     * @param $status
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function setStatus($status)
    {
        $this->status = $status;

//        if ($this->getPreviousRouteName() === 'idea')
//        {
            return redirect()->route('index', [
                'status' => $status
            ]);
//        }
    }


    /**
     * @return string|null
     */
    private function getPreviousRouteName() :string|null
    {
        return app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
    }

    public function mount()
    {
        if (URL::current() !== URL::route('index')) {
            $this->status = null;
            $this->queryString = [];
        }
    }


    public function render()
    {
        return view('livewire.status-filters');
    }
}
