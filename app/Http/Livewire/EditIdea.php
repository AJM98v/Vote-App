<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Idea;
use Livewire\Component;

class EditIdea extends Component
{
    public  $idea;
    public  $category;
    public  $title;
    public  $description;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        $this->title = $idea->title;
        $this->category = $idea->category_id;
        $this->description = $idea->description;

    }

    protected $rules = [
        "title" => "required|min:4",
        'category' => "required|integer",
        'description' => "required"
    ];

    public function editIdea()
    {
        if (auth()->check()){
            if (auth()->user()->cannot('update',$this->idea)){
                abort('403');
            }
        }else{
            abort('403',"You are Not Logged in");
        }

        $this->validate();
        $this->idea->update([
            'title' => $this->title,
            'description' => $this->description,
            'category_id' => $this->category
        ]);

        $this->dispatchBrowserEvent('close-modal');

        $this->emit('IdeaUpdate');

        session()->flash('message', "This Idea Updated Successfully");




    }

    public function render()
    {
        return view('livewire.edit-idea', [
            'categories' => Category::all()
        ]);
    }
}
