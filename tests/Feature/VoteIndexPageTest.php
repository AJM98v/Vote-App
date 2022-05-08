<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaIndex;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class VoteIndexPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     * @test
     */
    public function index_page_contains_idea_index_livewire_component() : void {
        $user = User::factory()->create();

        $Category = Category::factory()->create(['name'=>'category 1']);

        $status = Status::factory()->create(['name'=>'open' , 'color'=>'black']);

        $idea = Idea::factory()->create([
            'title'=>'My Idea',
            'user_id'=>$user->id,
            'category_id'=>$Category->id,
            'status_id'=>$status->id,
            'description'=>'About My Idea'
        ]);

        $response = $this->get(route('index'));
        $response->assertSeeLivewire('idea-index');


    }


    /**
     * @return void
     * @test
     */
    public function index_page_correctly_receives_votes_count() : void {
        $user = User::factory()->create();
        $userB = User::factory()->create();


        $Category = Category::factory()->create(['name'=>'category 1']);

        $status = Status::factory()->create(['name'=>'open' , 'color'=>'black']);

        $idea = Idea::factory()->create([
            'title'=>'My Idea',
            'user_id'=>$user->id,
            'category_id'=>$Category->id,
            'status_id'=>$status->id,
            'description'=>'About My Idea'
        ]);

        Vote::factory()->create([
            'idea_id'=>$idea->id,
            'user_id'=>$user->id
        ]);
        Vote::factory()->create([
            'idea_id'=>$idea->id,
            'user_id'=>$userB->id
        ]);

        $response = $this->get(route('index'));
        $response->assertSeeText('2');




    }

    /**
     * @return void
     * @test
     */

    public function votes_count_shows_correctly_on_index_page_livewire_component(): void
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



        Livewire::test(IdeaIndex::class,['idea'=>$idea])
            ->set('votes',2)
            ->assertSet('votes','2');



    }
}
