<?php

namespace Database\Seeders;

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
        $this->call(EncargadoEscuelaSeeder::class);
        $this->call(PeticionesSeeder::class);
        
    }
}
