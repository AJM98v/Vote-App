<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;

class MarkSpam extends Component
{
    public $idea;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function Report()
    {
         $this->idea->spam_report++;
         $this->idea->save();

    }

    public function render()
    {
        return view('livewire.mark-spam');
    }
}
