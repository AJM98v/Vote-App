<?php

namespace Tests\Feature;

use App\Http\Livewire\AddComment;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Notifications\CommentAdded;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;

class addCommentsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function add_comment_component_renders(): void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create();

        $status = Status::factory()->create();

        $idea = Idea::factory()->create([
            "title" => "Idea 1",
            'description' => "about Idea 1",
            "user_id" => $user->id,
            'category_id' => $category->id,
            "status_id" => $status->id
        ]);

        $this->get(route('idea', $idea))
            ->assertSeeLivewire("add-comment");
    }

    /**
     * @test
     */
    public function add_comment_form_does_not_render_when_user_not_logged_in(): void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create();

        $status = Status::factory()->create();

        $idea = Idea::factory()->create([
            "title" => "Idea 1",
            'description' => "about Idea 1",
            "user_id" => $user->id,
            'category_id' => $category->id,
            "status_id" => $status->id
        ]);

        $this->get(route('idea', $idea))
            ->assertSee('For Replay you must have Register');

    }


    /**
     * @test
     */
    public function add_comment_form_render_when_user_logged_in(): void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create();

        $status = Status::factory()->create();

        $idea = Idea::factory()->create([
            "title" => "Idea 1",
            'description' => "about Idea 1",
            "user_id" => $user->id,
            'category_id' => $category->id,
            "status_id" => $status->id
        ]);

        $this->actingAs($user)->get(route('idea', $idea))
            ->assertSee("Share your thoughts..");

    }

    /**
     * @test
     */
    public function add_comment_form_validation_works(): void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create();

        $status = Status::factory()->create();

        $idea = Idea::factory()->create([
            "title" => "Idea 1",
            'description' => "about Idea 1",
            "user_id" => $user->id,
            'category_id' => $category->id,
            "status_id" => $status->id
        ]);

        Livewire::actingAs($user)
            ->test(AddComment::class, [
                'idea'=>$idea
            ])
            ->set('comment', "")
            ->call("addComment")
            ->assertHasErrors(['comment']);
    }


    /**
     * @test
     * @throws \Exception
     */
    public function add_comment_works(): void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create();

        $status = Status::factory()->create();

        $idea = Idea::factory()->create([
            "title" => "Idea 1",
            'description' => "about Idea 1",
            "user_id" => $user->id,
            'category_id' => $category->id,
            "status_id" => $status->id
        ]);

        Notification::fake();

        Notification::assertNothingSent();


        Livewire::actingAs($user)
            ->test(AddComment::class, [
                'idea' => $idea
            ])
            ->set('comment', "this is my First comment")
            ->call("addComment");


        Notification::assertSentTo([$idea->user],CommentAdded::class);

        $this->assertDatabaseHas('comments', [
            'body' => "this is my First comment"
        ]);


    }


}

