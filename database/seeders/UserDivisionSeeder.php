<?php

namespace Database\Seeders;

use App\Models\UserDivision;
use Illuminate\Database\Seeder;

class UserDivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserDivision::factory(3)->create();
    }
}
