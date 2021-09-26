<?php

namespace Database\Seeders;

use App\Models\Solicitud;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SolicitudesSeeder extends Seeder
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

        $solicitudes = [
            [4,1,"2021-09-28","Quiero entrar para poder realizar mi servicio social","Aceptado"]
        ];

        foreach($solicitudes as $solicitud){
            Solicitud::create(['estudiante_id'=> $solicitud[0],'proyecto_social_id'=> $solicitud[1], 'fecha_solicitud'=>$solicitud[2],
            'justificacion_solicitud'=> $solicitud[3],'estado_solicitud'=> $solicitud[4]]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
