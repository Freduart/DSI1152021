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
        'password' => bcrypt('adminadmin'),
        'rol' => 'Administrador',
      ])->assignRole('Administrador');


      // Apartados de estudiantes
      $estudiantes = [
        ["Fredy","fredy@gmail.com","estudiante", "Estudiante"],
        ["Leo","leo@gmail.com","estudiante", "Estudiante"],
        ["Chico","chico@gmail.com","estudiante", "Estudiante"],
        ["Fransisco","ganuza@gmail.com","estudiante", "Estudiante"],
        ["Stefany","stefany@gmail.com","estudiante", "Estudiante"],
      ];

      foreach($estudiantes as $estudiante){
        User::create(['name' => $estudiante[0],'email' => $estudiante[1],'password' => bcrypt($estudiante[2]), 'rol' => $estudiante[3]])->assignRole('Estudiante');;
      }      

      // Apartado de instituciones
      $instituciones = [
        ["Applaudo","applaudo@gmail.com","institucion", "Institucion"],
        ["Novatech","novatech@gmail.com","institucion", "Institucion"],
      ];

      foreach($instituciones as $institucion){
        User::create(['name' => $institucion[0],'email' => $institucion[1],'password' => bcrypt($institucion[2]), 'rol' => $institucion[3]])->assignRole('Institucion');;
      }

      // Apartado de encargados de escuela

      $encargadosE = [
        ["Balmore", "balmore@gmail.com", "encargadoE", "Encargado Escuela"],
        ["Garcia", "garcia@gmail.com", "encargadoE", "Encargado Escuela"]
      ];

      foreach($encargadosE as $encargadoE){
        User::create(['name' => $encargadoE[0],'email' => $encargadoE[1],'password' => bcrypt($encargadoE[2]), 'rol' => $encargadoE[3]])->assignRole('Encargado Escuela');
      }

      // Encargados de facultad
      $encargadosF = [
        ["Alexis", "alexis@gmail.com", "encargadoF", "Encargado Facultad"],        
      ];

      foreach($encargadosF as $encargadoF){
        User::create(['name' => $encargadoF[0],'email' => $encargadoF[1],'password' => bcrypt($encargadoF[2]), 'rol' => $encargadoF[3]])->assignRole('Encargado Facultad');;
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
