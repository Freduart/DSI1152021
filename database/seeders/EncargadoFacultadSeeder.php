<?php

namespace Database\Seeders;

use App\Models\EncargadoFacultad;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EncargadoFacultadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        $encargadadosF = [
            [2,"EF0239856974","Alexis", "Pocasangre",11 ,"03079945-9", "alexis@gmail.com","7698-8425","Activo"],
        ];

        foreach($encargadadosF as $encargadoF){
            EncargadoFacultad::create(['facultad_id' => $encargadoF[0], 'codigo_encargado_facultad' => $encargadoF[1],'nombre_encargado_facultad' => $encargadoF[2],'apellido_encargado_facultad' => $encargadoF[3], 
            'user_id' => $encargadoF[4],'dui_encargado_facultad' => $encargadoF[5],'correo_encargado_facultad' => $encargadoF[6],'telefono_encargado_facultad' => $encargadoF[7],'estado_encargado_facultad' => $encargadoF[8]]);
        }
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
