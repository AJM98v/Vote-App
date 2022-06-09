<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaComments;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire;
use Tests\TestCase;

class showCommentsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function idea_comments_livewire_component_renders(): void
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

        $comment = Comment::factory()->create([
            "user_id" => $user->id,
            'idea_id' => $idea->id
        ]);

        $this->get(route("idea", $idea))->assertSeeLivewire("idea-comments");
    }



    /**
     * @test
     */
    public function idea_comment_livewire_component_renders(): void
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

        $comment = Comment::factory()->create([
            "user_id" => $user->id,
            'idea_id' => $idea->id
        ]);

        $this->get(route("idea", $idea))->assertSeeLivewire("idea-comment");
    }

    /**
     * @test
     */
    public function comment_count_show_correctly_on_index_page(): void
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

        $commentOne = Comment::factory()->create([
            "user_id" => $user->id,
            'idea_id' => $idea->id
        ]);
        $commentTwo = Comment::factory()->create([
            "user_id" => $user->id,
            'idea_id' => $idea->id
        ]);
        $commentThree = Comment::factory()->create([
            "user_id" => $user->id,
            'idea_id' => $idea->id
        ]);

        $this->get(route('index'))
            ->assertSee("3 comment");
    }

    /**
     * @test
     */

    public function author_badge_shows_when_author_make_a_comment(): void
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

        $comment = Comment::factory()->create([
            "user_id" => $user->id,
            'idea_id' => $idea->id
        ]);

        $this->get(route('idea',$idea))
            ->assertSee("Author");
    }

    /**
     * @test
     */
    public function comment_pagination_works() :void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create();

        $status = Status::factory()->create();

        $idea = Idea::factory()->create([
            "title"=>"idea 1",
            'description'=>"about idea 1",
            "user_id" => $user->id,
            'category_id' => $category->id,
            "status_id" => $status->id
        ]);

        Comment::factory()->count('13')->create([
            "idea_id"=>$idea->id,
            'user_id'=>$user->id
        ]);

        $commentOne = Comment::find('1');
        $commentOne->body= "First Comment";
        $commentOne->save();

        $lastComment = Comment::find('13');
        $lastComment->body= "last Comment";
        $lastComment->save();

        $response = $this->get(route('idea',$idea));
        $response->assertSee($commentOne->body);
        $response->assertDontSee($lastComment->body);

        $response = $this->get(route('idea',['idea'=>$idea , 'page'=>'2']));
        $response->assertSee($lastComment->body);
        $response->assertDontSee($commentOne->body);
    }

}
