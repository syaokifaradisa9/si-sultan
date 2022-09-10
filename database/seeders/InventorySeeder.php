<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inventory::create([
            'nama_barang' => 'Stop Kontak',
            'baik' => 3,
            'rusak_ringan' => 1,
            'rusak_berat' => 1,
            'division_id' => mt_rand(1, 5)
        ]);
        Inventory::create([
            'nama_barang' => 'Kabel Roll',
            'baik' => 3,
            'rusak_ringan' => 2,
            'rusak_berat' => 1,
            'division_id' => mt_rand(1, 5)
        ]);
    }
}
