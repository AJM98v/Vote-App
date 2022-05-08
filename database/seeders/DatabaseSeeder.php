<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::factory()->count('19')->create();
        $this->call([
            CategorySeeder::class,
            StatusSeeder::class,
            IdeaSeeder::class,
            VoteSeeder::class

        ]);


    }
}
