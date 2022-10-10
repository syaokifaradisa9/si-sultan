<?php

namespace Database\Seeders;

use App\Models\ProposeHp;
use Illuminate\Database\Seeder;

class ProposeHpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProposeHp::create([
            'usulan_hp' => 'kertas',
            'jumlah_hp' => 20,
            'spesifikasi_hp' => 'kertas hvs a4',
            'justifikasi_hp' => 'untuk melakukan print',
            'division_order_id' => 1
        ]);

        ProposeHp::create([
            'usulan_hp' => 'tinta',
            'jumlah_hp' => 10,
            'spesifikasi_hp' => 'berwana',
            'justifikasi_hp' => 'untuk melakukan print',
            'division_order_id' => 1
        ]);

        ProposeHp::create([
            'usulan_hp' => 'buku',
            'jumlah_hp' => 15,
            'spesifikasi_hp' => 'buku merk apa saja',
            'justifikasi_hp' => 'untuk melakukan pencatatan',
            'division_order_id' => 2
        ]);
    }
}
