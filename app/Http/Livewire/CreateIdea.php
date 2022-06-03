<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Idea;
use Livewire\Component;

class CreateIdea extends Component
{
    public  $title;
    public  $category = 1;
    public  $description;


   protected array $rules = [
       'title'=>'required|min:4',
       'category'=>'required|integer|exists:categories,id',
       'description'=>'required',
   ];



    public function render()
    {
        return view('livewire.create-idea', [
            'categories' => Category::all()
        ]);
    }

    public function createIdea()
    {
        $this->validate();

        Idea::create([
                'title' => $this->title,
                'category_id' => $this->category,
                'description' => $this->description,
                'user_id' => 1,
                'status_id' => 1
            ]);

            session()->flash('message','your Idea Added Successfully');

            $this->reset();

            return redirect()->route('index');

    }
}
