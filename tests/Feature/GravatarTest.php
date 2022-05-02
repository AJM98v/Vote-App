<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GravatarTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function user_gravatar_default_image_when_no_email() :void
    {
        $user = User::factory()->create([
            'name' => "Abolfazl",
            'email' => 'abolfazljafari563@gmail.com'
        ]);

        $imageUrl = $user->getAvatar();

        $this->assertEquals(
            "https://www.gravatar.com/avatar/".md5($user->email)."?d=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-1.png&s=200"
            ,$imageUrl);



//        $response = Http::get($imageUrl);
//        $this->assertTrue($response->successful());






    }
}
