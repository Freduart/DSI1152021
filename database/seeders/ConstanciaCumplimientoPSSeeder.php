<?php

namespace Database\Seeders;

// use ConstanciaCumplimientoProyectoSocial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConstanciaCumplimientoPSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        $constancias = [
            [1, 1],
        ];
        
        // foreach($constancia as $constancia){
        //     COnstancia::create(['constancia_cumplimiento_id' => $constancia[0], 'proyecto_social_id' => $constancia[1] ]);
        // }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

    }
}
