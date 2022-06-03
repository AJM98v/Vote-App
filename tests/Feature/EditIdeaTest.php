<?php

namespace Tests\Feature;

use App\Http\Livewire\EditIdea;
use App\Http\Livewire\IdeaShow;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EditIdeaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function shows_edit_idea_component_when_user_authorization(): void
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
            ->assertSeeLivewire("edit-idea");

    }


    /**
     * @test
     */
    public function does_not_shows_edit_idea_component_when_user_not_authorization(): void
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
            ->assertDontSeeLivewire("edit-idea");

    }

    /**
     * @test
     */
    public function editing_idea_works_when_user_authorization(): void
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => "category 1"]);
        $categoryTwo = Category::factory()->create(['name' => "category 2"]);
        $status = Status::factory()->create();

        $idea = Idea::create([
            'title' => "idea 1",
            'description' => "about idea 1",
            "user_id" => $user->id,
            'status_id' => $status->id,
            'category_id' => $categoryOne->id
        ]);

        Livewire::actingAs($user)
            ->test(EditIdea::class, [
                'idea' => $idea
            ])
            ->set('title', "My idea Updated")
            ->set("description", "About Update Idea")
            ->set('category', $categoryTwo->id)
            ->call("editIdea")
            ->assertEmitted("IdeaUpdate");

        $this->assertDatabaseHas('ideas', [
            'title' => "My idea Updated",
            'description' => "About Update Idea",
            'category_id' => $categoryTwo->id
        ]);
    }


    /**
     * @test
     */
    public function editing_idea_does_not_works_when_user_not_authorization_because_other_user_create_idea(): void
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => "category 1"]);
        $categoryTwo = Category::factory()->create(['name' => "category 2"]);
        $status = Status::factory()->create();

        $idea = Idea::create([
            'title' => "idea 1",
            'description' => "about idea 1",
            "user_id" => $user->id,
            'status_id' => $status->id,
            'category_id' => $categoryOne->id
        ]);

        Livewire::actingAs($userB)
            ->test(EditIdea::class, [
                'idea' => $idea
            ])
            ->set('title', "My idea Updated")
            ->set("description", "About Update Idea")
            ->set('category', $categoryTwo->id)
            ->call("editIdea")
            ->assertStatus(403);


    }



    /**
     * @test
     */
    public function editing_idea_does_not_works_when_user_not_authorization_because_idea_was_created_more_than_hour(): void
    {
        $user = User::factory()->create();


        $categoryOne = Category::factory()->create(['name' => "category 1"]);
        $categoryTwo = Category::factory()->create(['name' => "category 2"]);
        $status = Status::factory()->create();

        $idea = Idea::create([
            'title' => "idea 1",
            'description' => "about idea 1",
            "user_id" => $user->id,
            'status_id' => $status->id,
            'category_id' => $categoryOne->id,
            'created_at'=>now()->subHours(2)
        ]);

        Livewire::actingAs($user)->test(EditIdea::class, [
                'idea' => $idea
            ])
            ->set('title', "My idea Updated")
            ->set("description", "About Update Idea")
            ->set('category', $categoryTwo->id)
            ->call("editIdea")
            ->assertStatus(403);


    }


    /**
     * @return void
     * @test
     */
    public function edit_idea_form_validation_works(): void
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
            ->test(EditIdea::class, [
                'idea' => $idea
            ])
            ->set('title', "")
            ->set("description", "")
            ->set('category', "")
            ->call("editIdea")
            ->assertHasErrors(['title', 'description', 'category']);
    }


    /**
     * @test
     */
    public function edit_idea_shows_on_menu_when_user_authorization(): void
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
            ->assertSeeText("Edit Idea");

    }


    /**
     * @test
     */
    public function edit_idea_does_not_shows_on_menu_when_user_not_authorization(): void
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
            ->assertDontSeeText("Edit Idea");

    }


}
