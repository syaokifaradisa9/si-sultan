<?php

namespace Database\Seeders;
use App\Models\InventoryHp;
use Illuminate\Database\Seeder;

class InventoryHpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InventoryHp::create([
            'nama_barang' => 'Pulpen',
            'total' => 3,
            'division_id' => mt_rand(1, 5)
        ]);
        InventoryHp::create([
            'nama_barang' => 'Pensil',
            'total' => 3,
            'division_id' => mt_rand(1, 5)
        ]);
    }
}
