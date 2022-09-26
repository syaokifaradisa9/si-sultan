<?php

namespace Database\Seeders;

use App\Models\Propose;
use Illuminate\Database\Seeder;

class ProposeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Propose::create([
      'user_division_id' => mt_rand(1, 4),
      'usulan_thp' => 'printer',
      'jumlah_thp' => '5',
      'spesifikasi_thp' => 'merk epson',
      'justifikasi_thp' => 'untuk melakukan print'
    ]);
  }
}
