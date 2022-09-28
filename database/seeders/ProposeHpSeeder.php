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
            'user_division_id' => mt_rand(1, 4),
            'usulan_hp' => 'kertas',
            'jumlah_hp' => '20',
            'spesifikasi_hp' => 'kertas hvs a4',
            'justifikasi_hp' => 'untuk melakukan print'
        ]);
    }
}
