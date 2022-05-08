<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaShow;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class VoteShowPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     * @test
     */
    public function show_page_contains_idea_show_livewire_component(): void
    {
        $user = User::factory()->create();

        $Category = Category::factory()->create(['name' => 'category 1']);

        $status = Status::factory()->create(['name' => 'open', 'color' => 'black']);

        $idea = Idea::factory()->create([
            'title' => 'My Idea',
            'user_id' => $user->id,
            'category_id' => $Category->id,
            'status_id' => $status->id,
            'description' => 'About My Idea'
        ]);

        $response = $this->get(route('idea', $idea));
        $response->assertSeeLivewire('idea-show');


    }

    /**
     * @return void
     * @test
     */
    public function show_page_correctly_receives_votes_count(): void
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();


        $Category = Category::factory()->create(['name' => 'category 1']);

        $status = Status::factory()->create(['name' => 'open', 'color' => 'black']);

        $idea = Idea::factory()->create([
            'title' => 'My Idea',
            'user_id' => $user->id,
            'category_id' => $Category->id,
            'status_id' => $status->id,
            'description' => 'About My Idea'
        ]);

        Vote::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id
        ]);
        Vote::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $userB->id
        ]);

        Livewire::test(IdeaShow::class,['idea'=>$idea])->assertViewHas('votes',2);


    }

    /**
     * @return void
     * @test
     */

    public function votes_count_shows_correctly_on_show_page_livewire_component(): void
    {
        $user = User::factory()->create();

        $Category = Category::factory()->create(['name' => 'category 1']);

        $status = Status::factory()->create(['name' => 'open', 'color' => 'black']);

        $idea = Idea::factory()->create([
            'title' => 'My Idea',
            'user_id' => $user->id,
            'category_id' => $Category->id,
            'status_id' => $status->id,
            'description' => 'About My Idea'
        ]);



        Livewire::test(IdeaShow::class,['idea'=>$idea])
            ->set('votes',2)
            ->assertSet('votes','2');



    }
}
