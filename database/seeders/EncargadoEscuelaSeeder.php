<?php

namespace Database\Seeders;

use App\Models\EncargadoEscuela;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EncargadoEscuelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        $encargadadosE = [
            [4,"EE1234567890","Balmore", "Ortiz",9 ,"03079945-1", "balmore@gmail.com","7698-8412","Activo"],
            [4,"EE1234567333","Rudy", "Chicas",10 ,"03079945-0", "rudy@gmail.com","7698-8455","Activo"],
            [2,"EE0987654321","Carlos", "Garcia",11 ,"03079945-2", "garcia@gmail.com","7698-8413","Activo"],
        ];

        foreach($encargadadosE as $encargadoE){
            EncargadoEscuela::create(['carrera_id' => $encargadoE[0], 'codigo_encargado_escuela' => $encargadoE[1],'nombre_encargado_escuela' => $encargadoE[2],'apellido_encargado_escuela' => $encargadoE[3], 
            'user_id' => $encargadoE[4],'dui_encargado_escuela' => $encargadoE[5],'correo_encargado_escuela' => $encargadoE[6],'telefono_encargado_escuela' => $encargadoE[7],'estado_encargado_escuela' => $encargadoE[8]]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
