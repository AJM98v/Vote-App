<?php

namespace Tests\Feature;

use App\Http\Livewire\DeleteComment;
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

class DeleteCommentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function shows_delete_comment_component_when_user_authorization(): void
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
            ->assertSeeLivewire("delete-comment");

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
            ->assertDontSeeLivewire("delete-comment");

    }

    /**
     * @test
     */

    public function delete_comment_is_set_correctly(): void
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
            ->test(DeleteComment::class)
            ->call("setDeleteComment", $comment)
            ->assertSet("comment", $comment);


    }


    /**
     * @test
     */
    public function deleting_comment_works_when_user_authorization(): void
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
            ->test(DeleteComment::class)
            ->call("setDeleteComment", $comment)
            ->assertSet('comment', $comment)
            ->call('deleteComment')
            ->assertEmitted('deletedComment');

        $this->assertDatabaseMissing('comments', [
            'body' => $comment->body
        ]);

    }

    /**
     * @test
     */
    public function deleting_comment_does_not_works_when_user_not_authorization_because_other_user_create_comment(): void
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

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

        Livewire::actingAs($userB)
            ->test(DeleteComment::class, [
                'comment' => $comment
            ])
            ->call('setDeleteComment', $comment)
            ->call("deleteComment")
            ->assertStatus(403);

    }


    /**
     * @test
     */
    public function delete_comment_shows_on_menu_when_user_authorization(): void
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
            ->assertSeeText("Delete Comment");

    }


    /**
     * @test
     */
    public function Delete_Comment_does_not_shows_on_menu_when_user_not_authorization(): void
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
            ->assertDontSeeText("Delete Comment");

    }

}
