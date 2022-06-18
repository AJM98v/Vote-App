<?php

namespace Tests\Feature;

use App\Http\Livewire\EditComment;
use App\Http\Livewire\IdeaComment;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EditCommentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function shows_edit_comment_component_when_user_authorization(): void
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
            ->assertSeeLivewire("edit-comment");

    }


    /**
     * @test
     */
    public function does_not_shows_edit_comment_component_when_user_not_authorization(): void
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
            ->assertDontSeeLivewire("edit-comment");

    }

    /**
     * @test
     */
    public function editing_comment_works_when_user_authorization(): void
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

        $comment = Comment::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id
        ]);

        Livewire::actingAs($user)
            ->test(EditComment::class, [
                'comment' => $comment
            ])
            ->call('setEditComment', $comment->id)
            ->set('commentText', "This is Update Comment")
            ->call('editComment');

        $this->assertDatabaseHas('comments', [
            'body' => "This is Update Comment"
        ]);
    }


    /**
     * @test
     */
    public function editing_comment_does_not_works_when_user_not_authorization_because_other_user_create_idea(): void
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $category = Category::factory()->create(['name' => "category 1"]);

        $status = Status::factory()->create();

        $idea = Idea::create([
            'title' => "idea 1",
            'description' => "about idea 1",
            "user_id" => $user->id,
            'status_id' => $status->id,
            'category_id' => $category->id
        ]);

        $comment = Comment::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id
        ]);

        Livewire::actingAs($userB)
            ->test(EditComment::class, [
                'comment' => $comment
            ])
            ->call('setEditComment', $comment->id)
            ->set('commentText', "This is Update Comment")
            ->call('editComment');

        $this->assertDatabaseMissing('comments', [
            'body' => "This is Update Comment"
        ]);
    }


    /**
     * @test
     */

    public function edit_comment_is_set_correctly(): void
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

        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);

        Livewire::actingAs($user)
            ->test(EditComment::class)
            ->call("setEditComment", $comment->id)
            ->assertSet("commentText", $comment->body);

    }


    /**
     * @return void
     * @test
     */
    public function edit_comment_form_validation_works(): void
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

        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);

        Livewire::actingAs($user)
            ->test(EditComment::class)
            ->call("setEditComment", $comment->id)
            ->set("commentText", "")
            ->call('editComment')
            ->assertHasErrors(['commentText'])
            ->set('commentText', "ac")
            ->call('editComment')
            ->assertHasErrors(['commentText']);

    }


    /**
     * @test
     */
    public function edit_comment_shows_on_menu_when_user_authorization(): void
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

        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);

        Livewire::actingAs($user)
            ->test(IdeaComment::class, [
                'comment' => $comment, "ideaUserId" => $idea->user_id
            ])
            ->assertSeeText("Edit Comment");

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

        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id
        ]);


        Livewire::test(IdeaComment::class, [
            'comment' => $comment, "ideaUserId" => $idea->user_id
        ])
            ->assertDontSeeText("Edit Comment");

    }

}
