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
      'usulan_thp' => 'printer',
      'jumlah_thp' => 5,
      'spesifikasi_thp' => 'merk epson',
      'justifikasi_thp' => 'untuk melakukan print',
      'division_order_id' => 1
    ]);
  }
}
