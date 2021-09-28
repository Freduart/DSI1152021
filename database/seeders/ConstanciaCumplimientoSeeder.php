<?php

namespace Database\Seeders;

use App\Models\ConstanciaCumplimiento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConstanciaCumplimientoSeeder extends Seeder
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
            [4],
        ];

        foreach($constancias as $constancia){
            ConstanciaCumplimiento::create(['estudiante_id' => $constancia[0]]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
