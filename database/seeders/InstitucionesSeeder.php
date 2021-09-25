<?php

namespace Database\Seeders;

use App\Models\Institucion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitucionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        $instituciones = [
            [7,"Applaudo Studios","applaudo@gmail.com","Rudy Chicas","5456-9874","Zona Rosa","Tecnologia"],
            [8,"NovaTech","novatech@gmail.com","Karen Peñate","5456-9872","Santa Tecla","Consultoria"],
        ];

        foreach($instituciones as $institucion){
            Institucion::create(['user_id' => $institucion[0],'nombre_institucion' => $institucion[1],'contacto_institucion' => $institucion[3],'correo_institucion' => $institucion[2],
            'telefono_institucion' => $institucion[4],'ubicacion_institucion' => $institucion[5],'rubro_institucion' => $institucion[6]]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
