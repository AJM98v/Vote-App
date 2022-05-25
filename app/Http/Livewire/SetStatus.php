<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Status;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response ;

class SetStatus extends Component
{
    public $idea;
    public $status;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        $this->status = $idea->status_id;
    }

    public function setStatus()
    {
        if (auth()->user()->isAdmin()){
            $this->idea->update([
                "status_id"=>$this->status
            ]);
            $this->emit('statusUpdateEvent');
//            return redirect()->route('idea',$this->idea);
            $this->dispatchBrowserEvent('close-status');

        }else{
            abort(Response::HTTP_FORBIDDEN);
        }

    }
    public function render()
    {
        return view('livewire.set-status',[
            'statuses'=>Status::all()
        ]);
    }
}
