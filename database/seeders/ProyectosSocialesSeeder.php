<?php

namespace Database\Seeders;

use App\Models\ProyectoSocial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProyectosSocialesSeeder extends Seeder
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

        $proyectos = [
            [2,"En curso"],
        ];

        foreach($proyectos as $proyecto){
            ProyectoSocial::create(['peticion_id'=>$proyecto[0],'estado_proyecto_social'=>$proyecto[1]]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
