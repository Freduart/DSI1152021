<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facultad;

use Illuminate\Support\Facades\DB;

class FacultadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('facultades')->delete();

        $facultades = [
            'Facultad de Ciencias y Humanidades',
            'Facultad de Ingeníeria y Arquitectura',
            'Facultad de Agronomía',
            'Facultad de Odontología',
            'Facultad de Medicina',
            'Facultad de Jurisprudencia y Ciencias Sociales',
            'Facultad de Química y Farmacia',
            'Facultad de Ciencias Naturales y Matemática',
            'Facultad de Ciencias Económicas'
        ];
        
        //Llena la tabla facultades con los nombres
        foreach($facultades as $facultad){
            // DB::table('facultades')->insert([
            //     'nombre' => $facultad, 
            //     'created_at' => date('Y-m-d H:m:s'),
            //     'updated_at' => date('Y-m-d H:m:s')
            // ]);

            Facultad::create(['nombre_facultad' => $facultad]);
        }
    }
}
