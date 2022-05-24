<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeasIndex;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SearchFilterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function Search_filter_works(): void
    {
        $user = User::factory()->create();


        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $status = Status::factory()->create(['name' => 'open']);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $status->id,
            'title' => "Idea 1",
            'description' => 'About Idea 1'
        ]);
        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $status->id,
            'title' => "Idea 2",
            'description' => 'About Idea 2'
        ]);
        $ideaThree = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryTwo->id,
            'status_id' => $status->id,
            'title' => "Idea 3",
            'description' => 'About Idea 3'
        ]);



        Livewire::withQueryParams(['search'=>"Idea 3"])
            ->test(IdeasIndex::class)
            ->assertViewHas('ideas', fn($ideas) => $ideas->first()->title === 'Idea 3' && $ideas->count() === 1);


    }


    /**
     * @test
     * @returns void
     *
     */
    public function Search_filter_when_no_idea_found(): void
    {
        $user = User::factory()->create();


        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $status = Status::factory()->create(['name' => 'open']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering']);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $status->id,
            'title' => "Idea 1",
            'description' => 'About Idea 1'
        ]);
        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusConsidering->id,
            'title' => "Idea 2",
            'description' => 'About Idea 2'
        ]);
        $ideaThree = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryTwo->id,
            'status_id' => $status->id,
            'title' => "Idea 3",
            'description' => 'About Idea 3'
        ]);


        Livewire::withQueryParams([ 'search'=>"My Idea"])
            ->test(IdeasIndex::class)
            ->assertViewHas('ideas',
                fn($ideas) =>
                    $ideas->count() === 0
            )
        ->assertSeeText("No Ideas Found");
    }

    /**
     * @test
     * @returns void
     */
    public function My_idea_filter_works_correctly_with_category_filter(): void
    {

        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $status = Status::factory()->create(['name' => 'open']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering']);

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $status->id,
            'title' => "Idea 1",
            'description' => 'About Idea 1'
        ]);
        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusConsidering->id,
            'title' => "Idea 2",
            'description' => 'About Idea 2'
        ]);
        $ideaThree = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryTwo->id,
            'status_id' => $status->id,
            'title' => "Idea 3",
            'description' => 'About Idea 3'
        ]);
        $ideaFour = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $categoryTwo->id,
            'status_id' => $statusConsidering->id,
            'title' => "Idea 4",
            'description' => 'About Idea 4'
        ]);

        Livewire::withQueryParams(['category' => 'Category 1', 'filter'=>'My Ideas'])
            ->test(IdeasIndex::class)
            ->assertViewHas('ideas',
                fn($ideas) => $ideas->count() === 2);

    }


}
