<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(3)->create();

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'superadmin'
        ]);

        User::create([
            'name' => 'Mutu',
            'email' => 'to@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'tata_operasional'
        ]);

        User::create([
            'name' => 'adum',
            'email' => 'adum@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'administrasi_umum'
        ]);

        User::create([
            'name' => 'kepala',
            'email' => 'lpfk@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'kepala_lpfk'
        ]);
    }
}
