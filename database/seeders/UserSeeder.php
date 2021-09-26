<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        //
      User::create([
        'name' => 'admin',
        'email'=> 'admin@gmail.com',
        'password' => bcrypt('adminadmin')
      ])->assignRole('Administrador');


      // Apartados de estudiantes
      $estudiantes = [
        ["Fredy","fredy@gmail.com","estudiante"],
        ["Leo","leo@gmail.com","estudiante"],
        ["Chico","chico@gmail.com","estudiante"],
        ["Fransisco","ganuza@gmail.com","estudiante"],
        ["Stefany","stefany@gmail.com","estudiante"],
      ];

      foreach($estudiantes as $estudiante){
        User::create(['name' => $estudiante[0],'email' => $estudiante[1],'password' => bcrypt($estudiante[2])])->assignRole('Estudiante');;
      }      

      // Apartado de instituciones
      $instituciones = [
        ["Applaudo","applaudo@gmail.com","institucion"],
        ["Novatech","novatech@gmail.com","institucion"],
      ];

      foreach($instituciones as $institucion){
        User::create(['name' => $institucion[0],'email' => $institucion[1],'password' => bcrypt($institucion[2])])->assignRole('Institucion');;
      }

      // Apartado de encargados de escuela

      $encargadosE = [
        ["Balmore", "balmore@gmail.com", "encargadoE"],
        ["Garcia", "garcia@gmail.com", "encargadoE"]
      ];

      foreach($encargadosE as $encargadoE){
        User::create(['name' => $encargadoE[0],'email' => $encargadoE[1],'password' => bcrypt($encargadoE[2])])->assignRole('Encargado Escuela');
      }

      // Encargados de facultad
      $encargadosF = [
        ["Alexis", "alexis@gmail.com", "encargadoF"],        
      ];

      foreach($encargadosF as $encargadoF){
        User::create(['name' => $encargadoF[0],'email' => $encargadoF[1],'password' => bcrypt($encargadoF[2])])->assignRole('Encargado Facultad');;
      }

      // Apartados de encargados de facultad

      DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

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

        // User::create([
        //   'name' => 'estudiante',
        //   'email'=> 'estudiante@gmail.com',
        //   'password' => bcrypt('studiante')
        // ])->assignRole('Estudiante');
        

        // User::create([
        //   'name' => 'institucion',
        //   'email'=> 'institucion@gmail.com',
        //   'password' => bcrypt('institucion')
        // ])->assignRole('Institucion');

    }
}
