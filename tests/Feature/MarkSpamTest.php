<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaShow;
use App\Http\Livewire\MarkSpam;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MarkSpamTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @test
     */
    public function shows_mark_as_spam_idea_component(): void
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
            ->assertSeeLivewire("mark-spam");

    }

    /**
     * @test
     */
    public function mark_as_spam_shows_correctly_on_idea_page(): void
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

        $this->get(route('idea', $idea))
            ->assertSeeText('Mark As Spam');

    }

    /**
     * @test
     *
     */
    public function mark_as_spam_works_correctly(): void
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


        Livewire::test(MarkSpam::class, [
            'idea' => $idea
        ])
            ->call('Report');

        $this->assertDatabaseHas('ideas', [
            'spam_report' => "1"
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


        Livewire::actingAs($user)
            ->test(IdeaShow::class , [
                'idea'=>$idea
            ])
            ->assertSeeText("Not A Spam");



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


        Livewire::test(MarkSpam::class, [
                'idea' => $idea
            ])
            ->call("Report");

        $this->assertDatabaseHas('ideas',[
            'spam_report'=>"1"
        ]);

        Livewire::actingAs($user)
            ->test(IdeaShow::class, [
                'idea' => $idea
            ])
            ->call("resetSpam");

        $this->assertDatabaseHas('ideas',[
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

        Livewire::actingAs($userB)
            ->test(IdeaShow::class, [
                'idea' => $idea
            ])

            ->assertDontSeeText("Not A Spam");


    }

}
