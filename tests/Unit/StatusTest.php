<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     * @test
     */
    public function can_get_count_of_each_status(): void
    {
        $user = User::factory()->create();

        $category =Category::factory()->create(['name'=>'Category 1']);

        $statusOpen = Status::factory()->create(['name'=>'Open']);
        $statusClosed = Status::factory()->create(['name'=>'Closed']);
        $statusConsidering = Status::factory()->create(['name'=>'Considering']);
        $statusInProgress = Status::factory()->create(['name'=>'InProgress']);
        $statusImplemented = Status::factory()->create(['name'=>'Implemented']);


        Idea::factory()->create([
            'user_id'=>$user->id,
            'category_id'=>$category->id,
            'status_id'=>$statusOpen->id
        ]);
        Idea::factory()->create([
            'user_id'=>$user->id,
            'category_id'=>$category->id,
            'status_id'=>$statusConsidering->id
        ]);
        Idea::factory()->create([
            'user_id'=>$user->id,
            'category_id'=>$category->id,
            'status_id'=>$statusClosed->id
        ]);
        Idea::factory()->create([
            'user_id'=>$user->id,
            'category_id'=>$category->id,
            'status_id'=>$statusConsidering->id
        ]);
        Idea::factory()->create([
            'user_id'=>$user->id,
            'category_id'=>$category->id,
            'status_id'=>$statusImplemented->id
        ]);
        Idea::factory()->create([
            'user_id'=>$user->id,
            'category_id'=>$category->id,
            'status_id'=>$statusInProgress->id
        ]);
        Idea::factory()->create([
            'user_id'=>$user->id,
            'category_id'=>$category->id,
            'status_id'=>$statusImplemented->id
        ]);
        Idea::factory()->create([
            'user_id'=>$user->id,
            'category_id'=>$category->id,
            'status_id'=>$statusConsidering->id
        ]);
        Idea::factory()->create([
            'user_id'=>$user->id,
            'category_id'=>$category->id,
            'status_id'=>$statusClosed->id
        ]);
        Idea::factory()->create([
            'user_id'=>$user->id,
            'category_id'=>$category->id,
            'status_id'=>$statusOpen->id
        ]);
        Idea::factory()->create([
            'user_id'=>$user->id,
            'category_id'=>$category->id,
            'status_id'=>$statusImplemented->id
        ]);
        Idea::factory()->create([
            'user_id'=>$user->id,
            'category_id'=>$category->id,
            'status_id'=>$statusImplemented->id
        ]);
        Idea::factory()->create([
            'user_id'=>$user->id,
            'category_id'=>$category->id,
            'status_id'=>$statusClosed->id
        ]);
        Idea::factory()->create([
            'user_id'=>$user->id,
            'category_id'=>$category->id,
            'status_id'=>$statusOpen->id
        ]);
        Idea::factory()->create([
            'user_id'=>$user->id,
            'category_id'=>$category->id,
            'status_id'=>$statusConsidering->id
        ]);



        $this->assertEquals(15,Status::getCount()['all_status']);
        $this->assertEquals(3,Status::getCount()['open']);
        $this->assertEquals(4,Status::getCount()['considering']);
        $this->assertEquals(1,Status::getCount()['inProgress']);
        $this->assertEquals(4,Status::getCount()['implemented']);
        $this->assertEquals(3,Status::getCount()['closed']);



    }
}
