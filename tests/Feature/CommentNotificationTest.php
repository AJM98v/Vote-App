<?php

namespace Tests\Feature;

use App\Http\Livewire\AddComment;
use App\Http\Livewire\Notifications;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Notifications\DatabaseNotification;
use Livewire\Livewire;
use Tests\TestCase;

class CommentNotificationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     * @test
     */
    public function notification_component_renders_when_user_logged_in(): void
    {
        $user = User::factory()->create();


        $this->actingAs($user)->get(route('index'))
            ->assertSeeLivewire("notifications");
    }


    /**
     * @return void
     * @test
     */
    public function notification_component_does_not_renders_when_user_not_logged_in(): void
    {
        $user = User::factory()->create();


        $this->get(route('index'))
            ->assertDontSeeLivewire("notifications");
    }


    /**
     * @test
     *
     */

    public function notifications_show_for_logged_in_user(): void
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $category = Category::factory()->create();

        $status = Status::factory()->create();

        $idea = Idea::factory()->create([
            "title" => "Idea 1",
            'description' => "about Idea 1",
            "user_id" => $user->id,
            'category_id' => $category->id,
            "status_id" => $status->id
        ]);

        Livewire::actingAs($userB)
            ->test(AddComment::class, [
                'idea' => $idea
            ])
            ->set('comment', "this is my First comment")
            ->call("addComment");

        Livewire::actingAs($user)
            ->test(Notifications::class)
            ->call('getNotifications')
            ->assertSee("this is my First comment")
            ->assertSet('count', 1);
    }



    /**
     * @test
     *
     */

    public function mark_all_as_read_works(): void
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $category = Category::factory()->create();

        $status = Status::factory()->create();

        $idea = Idea::factory()->create([
            "title" => "Idea 1",
            'description' => "about Idea 1",
            "user_id" => $user->id,
            'category_id' => $category->id,
            "status_id" => $status->id
        ]);

        Livewire::actingAs($userB)
            ->test(AddComment::class, [
                'idea' => $idea
            ])
            ->set('comment', "this is my First comment")
            ->call("addComment");

        Livewire::actingAs($userB)
            ->test(AddComment::class, [
                'idea' => $idea
            ])
            ->set('comment', "this is my second comment")
            ->call("addComment");

        Livewire::actingAs($user)
            ->test(Notifications::class)
            ->call('getNotifications')
            ->call("markAllAsRead")
            ->assertSet('count', 0);

        $this->assertEquals(0 , $user->fresh()->unreadNotifications->count());
    }


    /**
     * @test
     *
     */
    public function mark_individual_as_read_works(): void
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $category = Category::factory()->create();

        $status = Status::factory()->create();

        $idea = Idea::factory()->create([
            "title" => "Idea 1",
            'description' => "about Idea 1",
            "user_id" => $user->id,
            'category_id' => $category->id,
            "status_id" => $status->id
        ]);

        Livewire::actingAs($userB)
            ->test(AddComment::class, [
                'idea' => $idea
            ])
            ->set('comment', "this is my First comment")
            ->call("addComment");

        Livewire::actingAs($userB)
            ->test(AddComment::class, [
                'idea' => $idea
            ])
            ->set('comment', "this is my second comment")
            ->call("addComment");

        Livewire::actingAs($user)
            ->test(Notifications::class)
            ->call('getNotifications')
            ->call("markAsRead", DatabaseNotification::first()->id)
            ->assertRedirect(route('idea', $idea));

    }



    /**
     * @test
     *
     */
    public function notification_idea_deleted_redirect_to_homePage(): void
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $category = Category::factory()->create();

        $status = Status::factory()->create();

        $idea = Idea::factory()->create([
            "title" => "Idea 1",
            'description' => "about Idea 1",
            "user_id" => $user->id,
            'category_id' => $category->id,
            "status_id" => $status->id
        ]);

        Livewire::actingAs($userB)
            ->test(AddComment::class, [
                'idea' => $idea
            ])
            ->set('comment', "this is my First comment")
            ->call("addComment");

        Livewire::actingAs($userB)
            ->test(AddComment::class, [
                'idea' => $idea
            ])
            ->set('comment', "this is my second comment")
            ->call("addComment");

        $idea->delete();

        Livewire::actingAs($user)
            ->test(Notifications::class)
            ->call('getNotifications')
            ->call("markAsRead", DatabaseNotification::first()->id)
            ->assertRedirect(route("index"));

    }

}
