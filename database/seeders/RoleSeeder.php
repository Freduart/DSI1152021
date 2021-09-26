<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrador = Role::create(['name' => 'Administrador']);
        $encargadoEsc = Role::create(['name' => 'Encargado Escuela']);
        $encargadoFac = Role::create(['name' => 'Encargado Facultad']);
        $estudiante = Role::create(['name' => 'Estudiante']);
        $institucion = Role::create(['name' => 'Institucion']);
        $ups = Role::create(['name' => 'Unidad de Proyeccion Social']);

        //encargado de facultad
        Permission::create(['name' => 'encargadosfacultad'])->syncRoles([$administrador, $ups]);

        Permission::create(['name' => 'encargadosfacultad.index'])->syncRoles([$administrador, $ups]);
        Permission::create(['name' => 'encargadosfacultad.create'])->syncRoles([$administrador, $ups]);
        Permission::create(['name' => 'encargadosfacultad.edit'])->syncRoles([$administrador, $ups]);
        Permission::create(['name' => 'encargadosfacultad.destroy'])->syncRoles([$administrador, $ups]);

        //encargado de escuela
        Permission::create(['name' => 'encargadosescuela'])->syncRoles([$administrador, $encargadoFac, $ups]);

        Permission::create(['name' => 'encargadosescuela.index'])->syncRoles([$administrador, $encargadoFac, $ups]);
        Permission::create(['name' => 'encargadosescuela.create'])->syncRoles([$administrador, $encargadoFac, $ups]);
        Permission::create(['name' => 'encargadosescuela.edit'])->syncRoles([$administrador, $encargadoFac, $ups]);
        Permission::create(['name' => 'encargadosescuela.destroy'])->syncRoles([$administrador, $encargadoFac, $ups]);

        //facultades
        Permission::create(['name' => 'facultades'])->syncRoles([$administrador, $ups]);

        Permission::create(['name' => 'facultades.index'])->syncRoles([$administrador, $ups]);
        Permission::create(['name' => 'facultades.create'])->syncRoles([$administrador, $ups]);
        Permission::create(['name' => 'facultades.edit'])->syncRoles([$administrador, $ups]);
        Permission::create(['name' => 'facultades.destroy'])->syncRoles([$administrador, $ups]);

        //carreras
        Permission::create(['name' => 'carreras'])->syncRoles([$administrador, $ups]);

        Permission::create(['name' => 'carreras.index'])->syncRoles([$administrador, $ups]);
        Permission::create(['name' => 'carreras.create'])->syncRoles([$administrador, $ups]);
        Permission::create(['name' => 'carreras.edit'])->syncRoles([$administrador, $ups]);
        Permission::create(['name' => 'carreras.destroy'])->syncRoles([$administrador, $ups]);

        //estudiantes
        Permission::create(['name' => 'estudiantes'])->syncRoles([$administrador, $encargadoEsc, $encargadoFac, $ups]);

        Permission::create(['name' => 'estudiantes.index'])->syncRoles([$administrador, $encargadoEsc, $encargadoFac, $ups]);
        Permission::create(['name' => 'estudiantes.create'])->syncRoles([$administrador, $encargadoEsc, $encargadoFac, $ups]);
        Permission::create(['name' => 'estudiantes.edit'])->syncRoles([$administrador, $encargadoEsc, $encargadoFac, $ups]);
        Permission::create(['name' => 'estudiantes.destroy'])->syncRoles([$administrador, $encargadoEsc, $encargadoFac, $ups]);

        //instituciones
        Permission::create(['name' => 'instituciones'])->syncRoles([$administrador, $encargadoEsc, $encargadoFac, $ups]);

        Permission::create(['name' => 'instituciones.index'])->syncRoles([$administrador, $encargadoEsc, $encargadoFac, $ups]);
        Permission::create(['name' => 'instituciones.create'])->syncRoles([$administrador, $encargadoEsc, $encargadoFac, $ups]);
        Permission::create(['name' => 'instituciones.edit'])->syncRoles([$administrador, $encargadoEsc, $encargadoFac, $ups]);
        Permission::create(['name' => 'instituciones.destroy'])->syncRoles([$administrador, $encargadoEsc, $encargadoFac, $ups]);

        
        //verificar cuenta
        Permission::create(['name' => 'verificarcuenta'])->syncRoles([$administrador, $encargadoEsc]);

        Permission::create(['name' => 'verificarcuenta.index'])->syncRoles([$administrador, $encargadoEsc]);
        Permission::create(['name' => 'verificarcuenta.create'])->syncRoles([$administrador, $encargadoEsc]);
        Permission::create(['name' => 'verificarcuenta.edit'])->syncRoles([$administrador, $encargadoEsc]);
        Permission::create(['name' => 'verificarcuenta.destroy'])->syncRoles([$administrador, $encargadoEsc]);

    }
}
