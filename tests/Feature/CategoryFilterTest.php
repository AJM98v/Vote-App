<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeasIndex;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CategoryFilterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function the_category_filters_works_correctly_with_queryString(): void
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


        Livewire::withQueryParams(['category' => 'Category 1'])
            ->test(IdeasIndex::class)
            ->assertViewHas('ideas', fn($ideas) => $ideas->first()->category->name === 'Category 1' && $ideas->count() === 2);


    }


    /**
     * @test
     * @returns void
     *
     */
    public function selecting_status_and_category_filters_works_correctly() :void
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

        Livewire::withQueryParams(['category' => 'Category 1', 'status'=>'open'])
            ->test(IdeasIndex::class)
            ->assertViewHas('ideas',
                fn($ideas) =>
                    $ideas->first()->category->name === 'Category 1'
                    && $ideas->count() === 1
                    && $ideas->first()->status->name === "open"
            );


    }

    /**
     * @test
     * @returns void
     */
    public function select_all_category_work_correctly() :void
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

        Livewire::withQueryParams(['category' => 'All'])
            ->test(IdeasIndex::class)
            ->assertViewHas('ideas',
                fn($ideas) => $ideas->count() === 4);

    }


}
