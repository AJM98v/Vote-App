<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeasIndex;
use App\Http\Livewire\StatusFilters;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class StatusFiltersTest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     *
     * @return void
     * @test
     */
    public function index_page_contains_status_filter_livewire_component(): void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'Category 1']);

        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => "My Idea",
            'description' => "About My Idea",
            'category_id' => $category->id,
            'status_id' => $statusOpen->id
        ]);

        $this->get(route('index'))
            ->assertSeeLivewire('status-filters');
    }


    /**.
     *
     * @return void
     * @test
     */
    public function show_page_contains_status_filter_livewire_component(): void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'Category 1']);

        $statusOpen = Status::factory()->create(['name' => 'Open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => "My Idea",
            'description' => "About My Idea",
            'category_id' => $category->id,
            'status_id' => $statusOpen->id
        ]);

        $this->get(route('idea', $idea))
            ->assertSeeLivewire('status-filters');
    }


    /**
     * @return void
     * @test
     */
    public function show_correct_status_count(): void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'Category 1']);

        $statusImplemented = Status::factory()->create(['id' => 5, 'name' => 'Implemented']);

        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => "My Idea",
            'description' => "About My Idea",
            'category_id' => $category->id,
            'status_id' => $statusImplemented->id
        ]);
        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => "My Idea 1",
            'description' => "About My Idea 1",
            'category_id' => $category->id,
            'status_id' => $statusImplemented->id
        ]);

        Livewire::test(StatusFilters::class)
            ->assertSee('All Ideas (2)')
            ->assertSee('implemented (2)');
    }


    /**
     * @return void
     * @test
     */
    public function filtering_work_when_query_string_in_place(): void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'Category 1']);

        $statusOpen = Status::factory()->create(['id' => 1, 'name' => 'Open']);
        $statusClosed = Status::factory()->create(['id' => 2, 'name' => 'Closed']);
        $statusConsidering = Status::factory()->create(['id' => 3, 'name' => 'Considering', 'color' => '#8b60ed']);
        $statusInProgress = Status::factory()->create(['id' => 4, 'name' => 'InProgress', 'color' => '#ffc73c']);
        $statusImplemented = Status::factory()->create(['id' => 5, 'name' => 'Implemented']);


        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => "My Idea",
            'description' => "About My Idea",
            'category_id' => $category->id,
            'status_id' => $statusConsidering->id
        ]);
        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => "My Idea 1",
            'description' => "About My Idea 1",
            'category_id' => $category->id,
            'status_id' => $statusConsidering->id
        ]);

        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => "My Idea",
            'description' => "About My Idea",
            'category_id' => $category->id,
            'status_id' => $statusInProgress->id
        ]);
        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => "My Idea 1",
            'description' => "About My Idea 1",
            'category_id' => $category->id,
            'status_id' => $statusInProgress->id
        ]);
        Idea::factory()->create([
            'user_id' => $user->id,
            'title' => "My Idea 1",
            'description' => "About My Idea 1",
            'category_id' => $category->id,
            'status_id' => $statusInProgress->id
        ]);

//        $response = $this->get(route('index',[
//            'status'=>"InProgress"
//        ]));
//        $response->assertSuccessful();
//        $response->assertSee('<div
//                            style="background-color: #ffc73c"
//                            class="text-white text-xxs font-bold uppercase leading-none text-center w-28 rounded-full h-7 py-2 px-4">
//                            InProgress
//                        </div>',false);
//        $response->assertDontSee('<div
//                            style="background-color: #8b60ed"
//                            class="text-white text-xxs font-bold uppercase leading-none text-center w-28 rounded-full h-7 py-2 px-4">
//                            Considering
//                        </div>',false);

        Livewire::withQueryParams(['status' => 'InProgress'])
            ->test(IdeasIndex::class)
            ->assertViewHas('ideas', fn($ideas) => $ideas->count() === 3
                && $ideas->first()->status->name === "InProgress"

            );

    }


    /**
     * @return void
     * @test
     */
    public function show_page_does_not_show_selected_status(): void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'Category 1']);

        $statusImplemented = Status::factory()->create(['id' => 5, 'name' => 'Implemented']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => "My Idea",
            'description' => "About My Idea",
            'category_id' => $category->id,
            'status_id' => $statusImplemented->id
        ]);


        $response = $this->get(route('idea', $idea));
        $response->assertDontSee('border-b-blue border-b-4 pb-3', false);
    }


    /**
     * @return void
     * @test
     */
    public function index_page_does_show_selected_status(): void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => 'Category 1']);

        $statusImplemented = Status::factory()->create(['id' => 5, 'name' => 'Implemented']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => "My Idea",
            'description' => "About My Idea",
            'category_id' => $category->id,
            'status_id' => $statusImplemented->id
        ]);


        $response = $this->get(route("index"));
        $response->assertSee('border-b-blue border-b-4 pb-3', false);
    }


}
