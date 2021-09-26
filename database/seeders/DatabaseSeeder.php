<?php

namespace Database\Seeders;

use App\Models\ConstanciaCumplimiento;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        $this->call(RoleSeeder::class);

        $this->call(UserSeeder::class);

        // \App\Models\User::factory(10)->create();

        // Se debe llamar en orden o se chingan todo
        $this->call(FacultadSeeder::class);
        $this->call(CarreraSeeder::class);
        $this->call(TipoServicioSocialSeeder::class);
        $this->call(InstitucionesSeeder::class);
        $this->call(EstudianteSeeder::class);
        $this->call(EncargadoEscuelaSeeder::class);
        
        $this->call(EncargadoFacultadSeeder::class);

        $this->call(PeticionesSeeder::class);

        $this->call(BitacorasSeeder::class);
        $this->call(ActividadesSeeder::class);
        // $this->call(PeticionesSeeder::class);
        $this->call(ProyectosSocialesSeeder::class);
        
        $this->call(ConstanciaCumplimientoSeeder::class);

        $this->call(SolicitudesSeeder::class);
    }
}
