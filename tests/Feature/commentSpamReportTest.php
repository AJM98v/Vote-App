<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaComment;
use App\Http\Livewire\IdeaComments;
use App\Http\Livewire\IdeaShow;
use App\Http\Livewire\SpamReportComments;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class commentSpamReportTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @test
     */
    public function shows_mark_as_spam_comment_component(): void
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
            "idea_id"=>$idea->id,
            'user_id'=>$user->id
        ]);


        $this->actingAs($user)->get(route('idea',$idea))
            ->assertSeeLivewire('spam-report-comments');

    }


    /**
     * @test
     */
    public function mark_as_spam_comment_component_does_not_show_when_not_auth(): void
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
            "idea_id"=>$idea->id,
            'user_id'=>$user->id
        ]);


        $this->get(route('idea',$idea))
            ->assertDontSeeLivewire('spam-report-comments');

    }

    /**
     * @test
     *
     */
    public function report_spam_comment_works_correctly(): void
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

        $comment = Comment::factory()->create([
            'user_id'=>$user->id,
            'idea_id'=>$idea->id
        ]);

        Livewire::actingAs($user)->test(SpamReportComments::class)
            ->call("setSpamComment", $comment)
            ->call('Report');

        $this->assertDatabaseHas('comments', [
            'spam_report'=>"1"
        ]);
    }


    /**
     * @test
     */
    public function not_a_spam_shows_when_admin_authorization(): void
    {
        $user = User::factory()->create([
            'email' => "abolfazljafari563@gmail.com"
        ]);

        $categoryOne = Category::factory()->create(['name' => "category 1"]);

        $status = Status::factory()->create();

        $idea = Idea::create([
            'title' => "idea 1",
            'description' => "about idea 1",
            "user_id" => $user->id,
            'status_id' => $status->id,
            'category_id' => $categoryOne->id
        ]);

        $comment = Comment::factory()->create([
            'idea_id'=>$idea->id,
            'user_id'=>$user->id
        ]);


       Livewire::actingAs($user)->test(IdeaComment::class, [$comment , $idea->user_id])
           ->assertSeeText('Not A Spam');



    }

    /**
     * @test
     */
    public function not_a_spam_works_when_admin_authorization(): void
    {
        $user = User::factory()->create([
            'email'=>"abolfazljafari563@gmail.com"
        ]);

        $categoryOne = Category::factory()->create(['name' => "category 1"]);

        $status = Status::factory()->create();

        $idea = Idea::factory()->create([
            'title' => "idea 1",
            'description' => "about idea 1",
            "user_id" => $user->id,
            'status_id' => $status->id,
            'category_id' => $categoryOne->id
        ]);


        $comment = Comment::factory()->create([
            'idea_id'=>$idea->id,
            'user_id'=>$user->id,
            'spam_report'=>"1"
        ]);


        Livewire::actingAs($user)->test(IdeaComment::class, [$comment , $idea->user_id])
            ->call('resetSpam');


        $this->assertDatabaseHas('comments',[
            'spam_report'=>"0"
        ]);
    }


    /**
     * @test
     */
    public function not_span_does_not_show_when_user_not_admin(): void
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

        $comment = Comment::factory()->create([
            'idea_id'=>$idea->id,
            'user_id'=>$user->id
        ]);


        Livewire::actingAs($user)->test(IdeaComment::class, [$comment , $idea->user_id])
            ->assertDontSeeText('Not A Spam');


    }
}
