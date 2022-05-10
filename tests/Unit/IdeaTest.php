<?php

namespace Tests\Unit;

use App\Exceptions\VoteDuplicateExption;
use App\Exceptions\VoteNotFOundExption;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IdeaTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @return void
     * @test
     */
    public function can_check_idea_is_voted_for_by_user() : void
    {

        $user = User::factory()->create();
        $userB = User::factory()->create();

        $Category = Category::factory()->create(['name'=>'category 1']);

        $status = Status::factory()->create(['name'=>'open' , 'color'=>'black']);

        $idea = Idea::factory()->create([
            'title'=>'My Idea',
            'user_id'=>$user->id,
            'category_id'=>$Category->id,
            'status_id'=>$status->id,
            'description'=>'About My Idea'
        ]);

        Vote::factory()->create([
            'idea_id'=>$idea->id,
            'user_id'=>$user->id
        ]);


        $this->assertTrue($idea->isVotedByUser($user));
        $this->assertFalse($idea->isVotedByUser($userB));
        $this->assertFalse($idea->isVotedByUser(null));

    }

    /**
     * @return void
     * @test
     */

    public function user_can_vote_for_idea() : void
    {

        $user = User::factory()->create();

        $Category = Category::factory()->create(['name'=>'category 1']);

        $status = Status::factory()->create(['name'=>'open' , 'color'=>'black']);

        $idea = Idea::factory()->create([
            'title'=>'My Idea',
            'user_id'=>$user->id,
            'category_id'=>$Category->id,
            'status_id'=>$status->id,
            'description'=>'About My Idea'
        ]);

        $this->assertFalse($idea->isVotedByUser($user));
        $idea->vote($user);
       $this->assertTrue($idea->isVotedByUser($user));

    }



    /**
     * @return void
     * @test
     */
    public function user_can__un_vote_for_idea() : void
    {

        $user = User::factory()->create();

        $Category = Category::factory()->create(['name'=>'category 1']);

        $status = Status::factory()->create(['name'=>'open' , 'color'=>'black']);

        $idea = Idea::factory()->create([
            'title'=>'My Idea',
            'user_id'=>$user->id,
            'category_id'=>$Category->id,
            'status_id'=>$status->id,
            'description'=>'About My Idea'
        ]);

        Vote::factory()->create([
            'idea_id'=>$idea->id,
            'user_id'=>$user->id
        ]);

        $this->assertTrue($idea->isVotedByUser($user));
        $idea->removeVote($user);
       $this->assertFalse($idea->isVotedByUser($user));

    }


    /**
     * @test
     * @return void
     */
    public function voting_for_idea_that_already_voted_for_throws_exception() :void
    {
        $user = User::factory()->create();

        $Category = Category::factory()->create(['name'=>'category 1']);

        $status = Status::factory()->create(['name'=>'open' , 'color'=>'black']);

        $idea = Idea::factory()->create([
            'title'=>'My Idea',
            'user_id'=>$user->id,
            'category_id'=>$Category->id,
            'status_id'=>$status->id,
            'description'=>'About My Idea'
        ]);

        Vote::factory()->create([
            'idea_id'=>$idea->id,
            'user_id'=>$user->id
        ]);

        $this->expectException(VoteDuplicateExption::class);
        $idea->vote($user);

    }

    /**
     * @test
     * @return void
     */
    public function remove_vote_for_idea_that_already_removed_for_throws_exception() :void
    {
        $user = User::factory()->create();

        $Category = Category::factory()->create(['name'=>'category 1']);

        $status = Status::factory()->create(['name'=>'open' , 'color'=>'black']);

        $idea = Idea::factory()->create([
            'title'=>'My Idea',
            'user_id'=>$user->id,
            'category_id'=>$Category->id,
            'status_id'=>$status->id,
            'description'=>'About My Idea'
        ]);


        $this->expectException(VoteNotFOundExption::class);
        $idea->removeVote($user);

    }


}
