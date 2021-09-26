<?php

namespace Database\Seeders;

use App\Models\Actividad;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActividadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        $actividades = [
            [1,"Se aprendio sobre la metodologia de trabajo","2021-09-25","4","Aceptada"],
            [1,"Se resolvio un bug","2021-09-26","2","En espera"],
        ];

        foreach($actividades as $actividad){
            Actividad::create(['bitacora_id' => $actividad[0],'nombre_actividad' => $actividad[1],'fecha_actividad' => $actividad[2],'total_horas' => $actividad[3],'verificado' => $actividad[4]]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
