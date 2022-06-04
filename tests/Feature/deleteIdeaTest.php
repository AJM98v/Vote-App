<?php

namespace Tests\Feature;

use App\Http\Livewire\DeleteIdea;
use App\Http\Livewire\EditIdea;
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

class deleteIdeaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function shows_delete_idea_component_when_user_authorization(): void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create();
        $status = Status::factory()->create();

        $idea = Idea::create([
            'title' => "idea 1",
            'description' => "about idea 1",
            "user_id" => $user->id,
            'status_id' => $status->id,
            'category_id' => $category->id
        ]);

        $this->actingAs($user)->get(route('idea', $idea))
            ->assertSeeLivewire("delete-idea");

    }


    /**
     * @test
     */
    public function does_not_shows_delete_idea_component_when_user_not_authorization(): void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create();
        $status = Status::factory()->create();

        $idea = Idea::create([
            'title' => "idea 1",
            'description' => "about idea 1",
            "user_id" => $user->id,
            'status_id' => $status->id,
            'category_id' => $category->id
        ]);

        $this->get(route('idea', $idea))
            ->assertDontSeeLivewire("delete-idea");

    }

    /**
     * @test
     */
    public function deleting_idea_works_when_user_authorization(): void
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => "category 1"]);

        $status = Status::factory()->create();

        $idea = Idea::create([
            'title' => "idea 1",
            'description' => "about idea 1",
            "user_id" => $user->id,
            'status_id' => $status->id,
            'category_id' => $categoryOne->id
        ]);

        Livewire::actingAs($user)
            ->test(DeleteIdea::class, [
                'idea' => $idea
            ])
            ->call("deleteIdea")
            ->assertRedirect(route('index'));

        $this->assertDatabaseMissing('ideas', [
            'title' => "idea 1",
            'description' => "About idea 1",
            'category_id' => $categoryOne->id
        ]);

    }

    /**
     * @test
     */
    public function deleting_idea_works_when_user_authorization_with_deleting_votes(): void
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => "category 1"]);

        $status = Status::factory()->create();

        $idea = Idea::factory()->create([
            'title' => "idea 1",
            'description' => "about idea 1",
            "user_id" => $user->id,
            'status_id' => $status->id,
            'category_id' => $categoryOne->id
        ]);

        Vote::factory()->create([
            'idea_id'=>$idea->id,
            'user_id'=>$user->id
        ]);

        Livewire::actingAs($user)
            ->test(DeleteIdea::class, [
                'idea' => $idea
            ])
            ->call("deleteIdea")
            ->assertRedirect(route('index'));

        $this->assertDatabaseMissing('ideas', [
            'title' => "idea 1",
            'description' => "About idea 1",
            'category_id' => $categoryOne->id
        ]);
        $this->assertDatabaseMissing('votes' , [
            'idea_id'=>$idea->id
        ]);

    }


    /**
     * @test
     */
    public function deleting_idea_does_not_works_when_user_not_authorization_because_other_user_create_idea(): void
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => "category 1"]);

        $status = Status::factory()->create();

        $idea = Idea::create([
            'title' => "idea 1",
            'description' => "about idea 1",
            "user_id" => $user->id,
            'status_id' => $status->id,
            'category_id' => $categoryOne->id
        ]);

        Livewire::actingAs($userB)
            ->test(DeleteIdea::class, [
                'idea' => $idea
            ])
            ->call("deleteIdea")
            ->assertStatus(403);


    }


    /**
     * @test
     */
    public function delete_idea_shows_on_menu_when_user_authorization(): void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create();
        $status = Status::factory()->create();

        $idea = Idea::create([
            'title' => "idea 1",
            'description' => "about idea 1",
            "user_id" => $user->id,
            'status_id' => $status->id,
            'category_id' => $category->id
        ]);

        Livewire::actingAs($user)
            ->test(IdeaShow::class, [
                'idea' => $idea
            ])
            ->assertSeeText("Delete Idea");

    }


    /**
     * @test
     */
    public function Delete_idea_does_not_shows_on_menu_when_user_not_authorization(): void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create();
        $status = Status::factory()->create();

        $idea = Idea::create([
            'title' => "idea 1",
            'description' => "about idea 1",
            "user_id" => $user->id,
            'status_id' => $status->id,
            'category_id' => $category->id
        ]);

        Livewire::test(IdeaShow::class, [
            'idea' => $idea
        ])
            ->assertDontSeeText("Delete Idea");

    }

}
