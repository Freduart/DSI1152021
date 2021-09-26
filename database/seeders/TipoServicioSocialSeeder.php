<?php

namespace Database\Seeders;

use App\Models\TipoServicioSocial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoServicioSocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        $tipoServiciosSociales = [
            ["Pasantia"],
            ["Documentacion"],
            ["Interinato"],            
        ];

        foreach($tipoServiciosSociales  as $tipoS){
            TipoServicioSocial::create(['nombre_tipo_servicio' => $tipoS[0]]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
