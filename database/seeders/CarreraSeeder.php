<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Carrera;

class CarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crea cosas aleatorias pero no lo queremos asi
        // \App\Models\Carrera::factory()->count(12)->create();        
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        
        $carreras = [
            ["Ingeniería Agronómica", "I10304", 56,3, "Activo"],
            ["Doctorado en Medicina", "M10304",60, 5, "Activo"],
            ["Licenciatura en Periodismo", "L10409", 46,1, "Activo"],
            ["Ingeniería de Sistemas Informaticos", "I10515", 48,2, "Activo"],
            ["Doctorado en Cirugia Dental", "F10304", 56,4, "Activo"],
            ["Licenciatura en Relaciones Internacionales", "L10202", 49, 6, "Activo"],
            ["Licenciatura en Química y Farmacia", "L10601", 43,7, "Activo"],
            ["Licenciatura en Matemática", "L10940", 33,8, "Activo"],
            ["Licenciatura en Mercadeo Internacional", "L1080L", 43,9, "Activo"],
            
        ];
        
        foreach($carreras as $carrera){
            Carrera::create(['nombre_carrera' => $carrera[0], 'codigo_carrera'=> $carrera[1], 'materias_para_aprobar'=>$carrera[2], 'facultad_id'=>$carrera[3], 'estado_carrera'=>$carrera[4]]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

    }
}