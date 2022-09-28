<?php

namespace Database\Seeders;

use App\Models\DivisionOrder;
use Illuminate\Database\Seeder;

class DivisionOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DivisionOrder::create([
            'user_division_id' => mt_rand(1, 4)
        ]);
    }
}
