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

    UserDivision::create([
      'name' => 'addiv',
      'email' => 'addiv@gmail.com',
      'password' => bcrypt('123'),
      'role' => 'admin_divisi',
      'division_id' => 1
    ]);

    UserDivision::create([
      'name' => 'kadiv',
      'email' => 'kadiv@gmail.com',
      'password' => bcrypt('123'),
      'role' => 'ppk',
      'division_id' => 1
    ]);
  }
}
