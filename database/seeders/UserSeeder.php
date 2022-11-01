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
            'password' => bcrypt(123),
            'role' => 'superadmin'
        ]);

        User::create([
            'name' => 'Mutu',
            'email' => 'mutu@gmail.com',
            'password' => bcrypt(123),
            'role' => 'mutu'
        ]);

        User::create([
            'name' => 'adum',
            'email' => 'adum@gmail.com',
            'password' => bcrypt(123),
            'role' => 'administrasi_umum'
        ]);

        User::create([
            'name' => 'lpfk',
            'email' => 'lpfk@gmail.com',
            'password' => bcrypt(123),
            'role' => 'kepala_lpfk'
        ]);
        User::create([
            'name' => 'ppk',
            'email' => 'ppk@gmail.com',
            'password' => bcrypt(123),
            'role' => 'kepala_lpfk'
        ]);
    }
}
