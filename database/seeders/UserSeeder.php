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
        //
        User::create([
          'name' => 'admin',
          'email'=> 'admin@gmail.com',
          'password' => bcrypt('adminadmin')
        ])->assignRole('Administrador');

        /*User::create([
          'name' => 'facultad',
          'email'=> 'facultad@gmail.com',
          'password' => bcrypt('adminadmin')
        ])->assignRole('Encargado Facultad');

        User::create([
          'name' => 'facultad2',
          'email'=> 'facultad2@gmail.com',
          'password' => bcrypt('adminadmin')
        ])->assignRole('Encargado Facultad');

        User::create([
          'name' => 'escuela',
          'email'=> 'escuela@gmail.com',
          'password' => bcrypt('adminadmin')
        ])->assignRole('Encargado Escuela');*/

    }
}
