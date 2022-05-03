<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Status::create([
            'name' => 'open',
            'color' => '#000'
        ]);
        Status::create([
            'name' => 'close',
            'color' => '#ec454f'
        ]);
        Status::create([
            'name' => 'Considering',
            'color' => '#8b60ed'
        ]);
        Status::create([
            'name' => 'In Progress',
            'color' => '#ffc73c'
        ]);
        Status::create([
            'name' => 'Implemented',
            'color' => '#1aab8b'
        ]);
    }
}
