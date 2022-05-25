<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function can_check_if_user_is_an_admin() :void
    {
        $user = User::factory()->create(['email'=>"lakaledop@mailinator.com"]);
        $userB  = User::factory()->create();


        $this->assertTrue($user->isAdmin());
        $this->assertFalse($userB->isAdmin());

    }

}
