<?php

namespace Database\Seeders;

use App\Models\Estudiante;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstudianteSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// \App\Models\Estudiante::factory()->count(15)->create();
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

		$estudiantes = [
				["Fredy","Martinez",2,"MM16045","Masculino","fredy@gmail.com","7911-9346",1,"05570933-6","0702-110897-101-3",30,63.00,0,"Activo"],
				["Leo","Urquilla",3,"UR17008","Masculino","leo@gmail.com","6539-9871",2,"05570933-7","0702-110897-101-4",32,59.00,0,"Activo"],
				["Chico","Santana",4,"SM16006","Masculino","chico@gmail.com","6539-9872",3,"05570933-8","0702-110897-101-5",32,63.00,0,"Activo"],
				["Fransisco","Ganuza",5,"GR18015","Masculino","fransisco@gmail.com","6539-9873",4,"05570933-9","0702-110897-101-6",32,76.00,0,"Realizando servicio"],
				["Stefany","Ruiz",6,"RR16003","Femenino","stefany@gmail.com","6539-9874",5,"05570933-1","0702-110897-101-7",32,91.00,0,"Activo"],
		];

		foreach($estudiantes as $estudiante){
			Estudiante::create(['nombre_estudiante' => $estudiante[0],'apellido_estudiante' => $estudiante[1],'user_id' => $estudiante[2],'carnet_estudiante' => $estudiante[3],'sexo_estudiante' => $estudiante[4],
			'correo_estudiante' => $estudiante[5],'telefono_estudiante' => $estudiante[6],'carrera_id' => $estudiante[7],'dui_estudiante' => $estudiante[8],'nit_estudiante' => $estudiante[9],'materias_cursadas' => $estudiante[10],
			'porcentaje_aprobacion' => $estudiante[11],'cantidad_horas_ss' => $estudiante[12],'estado_estudiante' => $estudiante[13]]);
		}

		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
	}
}
