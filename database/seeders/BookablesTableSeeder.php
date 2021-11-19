<?php

namespace Database\Seeders;

use App\Models\Bookable;
use Illuminate\Database\Seeder;

class BookablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        if(config('app.debug') == true) {
            Bookable::factory()
                ->count(100)
                ->create();

            dump("Bookable factory - seeded");
        }

    }
}
