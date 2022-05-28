<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaShow;
use App\Http\Livewire\SetStatus;
use App\Jobs\NotifyVoters;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;
use Tests\TestCase;

class AdminSetStatusTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function show_page_contains_Set_status_livewire_component_when_user_is_Admin(): void
    {
        $user = User::factory()->create(['email' => "abolfazljafari563@gmail.com"]);

        $category = Category::factory()->create(['name' => "Category 1"]);

        $status = Status::factory()->create(['name' => 'open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $status->id,
            'title' => "Idea 1",
            'description' => "About Idea 1"
        ]);

        $this->actingAs($user)
            ->get(route('idea', $idea))
            ->assertSeeLivewire('set-status');

    }

    /** A basic feature test example.
     * @test
     * @return void
     */
    public function show_page_do_not_contains_Set_status_livewire_component_when_user_not_Admin(): void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create(['name' => "Category 1"]);

        $status = Status::factory()->create(['name' => 'open']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $status->id,
            'title' => "Idea 1",
            'description' => "About Idea 1"
        ]);

        $this->actingAs($user)
            ->get(route('idea', $idea))
            ->assertDontSeeLivewire('set-status');

    }

    /**
     * @test
     */
    public function initial_status_is_set_correctly(): void
    {
        $user = User::factory()->create([
            'email'=>"abolfazljafari563@gmail.com"
        ]);

        $category = Category::factory()->create(['name' => "Category 1"]);

        $status = Status::factory()->create(['name' => 'close', 'id'=>"2"]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $status->id,
            'title' => "Idea 1",
            'description' => "About Idea 1"
        ]);

        Livewire::actingAs($user)
            ->test(SetStatus::class , [
                'idea'=>$idea
            ])
            ->assertSet('status',$status->id);

    }

    /**
     *@test
     */

    public function can_set_status_correctly() :void
    {
        $user = User::factory()->create(['email' => "abolfazljafari563@gmail.com"]);

        $category = Category::factory()->create(['name' => "Category 1"]);

        $status = Status::factory()->create(['name' => 'open' , "id"=>1]);
        $statusInProgress = Status::factory()->create(['name' => 'InProgress' , "id"=>4]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'status_id' => $status->id,
            'title' => "Idea 1",
            'description' => "About Idea 1"
        ]);

        Livewire::actingAs($user)
            ->test(SetStatus::class,[
                'idea'=>$idea
            ])
            ->set('status',$statusInProgress->id)
            ->call('setStatus')
            ->assertEmitted("statusUpdateEvent");

        $this->assertDatabaseHas('ideas',[
            "id"=>$idea->id,
            'status_id'=>$statusInProgress->id
        ]);
    }


}
