<?php

namespace Database\Seeders;

use App\Models\Bitacora;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BitacorasSeeder extends Seeder
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

        $bitacoras = [
            [375, "Ninguna", NULL, 4, 1],
        ];

        foreach($bitacoras as $bitacora){
            Bitacora::create(['total_horas' => $bitacora[0], 'observaciones_bitacora' => $bitacora[1], 'documento_pdf' => $bitacora[2], 
            'estudiante_id' => $bitacora[3], 'proyecto_social_id' => $bitacora[4]]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
