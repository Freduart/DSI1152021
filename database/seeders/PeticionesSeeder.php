<?php

namespace Database\Seeders;

use App\Models\Peticion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeticionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        $peticiones = [
            [2,"Pasantia para desarrollo","Se necesita dos estudiantes con ganas de aprender","San Salvador","2021-09-24","2021-10-10",300,null,"En espera","applaudo@gmail.com",4,1,1],
        ];

        foreach($peticiones as $peticion){
            Peticion::create(['cantidad_estudiantes' => $peticion[0],'nombre_peticion' => $peticion[1],'descripcion_peticion' => $peticion[2],'ubicacion_actividades' => $peticion[3],
            'fecha_peticion' => $peticion[4],'fecha_peticion_fin' => $peticion[5],'cantidad_horas' => $peticion[6],'otros_tipo_servicio' => $peticion[7],'estado_peticion' => $peticion[8],'correo_peticion' => $peticion[9],
            'carrera_id' => $peticion[10],'tipo_servicio_social_id' => $peticion[11],'institucion_id' => $peticion[12]]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
