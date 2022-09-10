<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Division::create([
            'nama' => 'Manajemen'
        ]);
        Division::create([
            'nama' => 'Lab PK'
        ]);
        Division::create([
            'nama' => 'Lab UK'
        ]);
        Division::create([
            'nama' => 'Lab PDP'
        ]);
        Division::create([
            'nama' => 'Lab Sapras'
        ]);
    }
}
