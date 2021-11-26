<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(config('app.debug') == true) {
            User::factory()
                ->count(100)
                ->create();

            dump("User factory - seeded");
        }
    }
}
