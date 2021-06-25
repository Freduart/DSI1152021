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
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Encargado Escuela']);
        $role3 = Role::create(['name' => 'Encargado Facultad']);
        $role4 = Role::create(['name' => 'Estudiante']);
        $role5 = Role::create(['name' => 'Institucion']);
        $role6 = Role::create(['name' => 'Unidad de Proyeccion Social']);

        //encargado de facultad
        Permission::create(['name' => 'encargadosfacultad'])->syncRoles([$role1, $role6]);

        Permission::create(['name' => 'encargadosfacultad.index'])->syncRoles([$role1, $role6]);
        Permission::create(['name' => 'encargadosfacultad.create'])->syncRoles([$role1, $role6]);
        Permission::create(['name' => 'encargadosfacultad.edit'])->syncRoles([$role1, $role6]);
        Permission::create(['name' => 'encargadosfacultad.destroy'])->syncRoles([$role1, $role6]);

        //encargado de escuela
        Permission::create(['name' => 'encargadosescuela'])->syncRoles([$role1, $role3, $role6]);

        Permission::create(['name' => 'encargadosescuela.index'])->syncRoles([$role1, $role3, $role6]);
        Permission::create(['name' => 'encargadosescuela.create'])->syncRoles([$role1, $role3, $role6]);
        Permission::create(['name' => 'encargadosescuela.edit'])->syncRoles([$role1, $role3, $role6]);
        Permission::create(['name' => 'encargadosescuela.destroy'])->syncRoles([$role1, $role3, $role6]);

        //facultades
        Permission::create(['name' => 'facultades'])->syncRoles([$role1, $role6]);

        Permission::create(['name' => 'facultades.index'])->syncRoles([$role1, $role6]);
        Permission::create(['name' => 'facultades.create'])->syncRoles([$role1, $role6]);
        Permission::create(['name' => 'facultades.edit'])->syncRoles([$role1, $role6]);
        Permission::create(['name' => 'facultades.destroy'])->syncRoles([$role1, $role6]);

        //carreras
        Permission::create(['name' => 'carreras'])->syncRoles([$role1, $role6]);

        Permission::create(['name' => 'carreras.index'])->syncRoles([$role1, $role6]);
        Permission::create(['name' => 'carreras.create'])->syncRoles([$role1, $role6]);
        Permission::create(['name' => 'carreras.edit'])->syncRoles([$role1, $role6]);
        Permission::create(['name' => 'carreras.destroy'])->syncRoles([$role1, $role6]);

        //estudiantes
        Permission::create(['name' => 'estudiantes'])->syncRoles([$role1, $role2, $role3, $role6]);

        Permission::create(['name' => 'estudiantes.index'])->syncRoles([$role1, $role2, $role3, $role6]);
        Permission::create(['name' => 'estudiantes.create'])->syncRoles([$role1, $role2, $role3, $role6]);
        Permission::create(['name' => 'estudiantes.edit'])->syncRoles([$role1, $role2, $role3, $role6]);
        Permission::create(['name' => 'estudiantes.destroy'])->syncRoles([$role1, $role2, $role3, $role6]);

        //instituciones
        Permission::create(['name' => 'instituciones'])->syncRoles([$role1, $role2, $role3, $role6]);

        Permission::create(['name' => 'instituciones.index'])->syncRoles([$role1, $role2, $role3, $role6]);
        Permission::create(['name' => 'instituciones.create'])->syncRoles([$role1, $role2, $role3, $role6]);
        Permission::create(['name' => 'instituciones.edit'])->syncRoles([$role1, $role2, $role3, $role6]);
        Permission::create(['name' => 'instituciones.destroy'])->syncRoles([$role1, $role2, $role3, $role6]);

        
        //verificar cuenta
        Permission::create(['name' => 'verificarcuenta'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'verificarcuenta.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'verificarcuenta.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'verificarcuenta.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'verificarcuenta.destroy'])->syncRoles([$role1, $role2]);

    }
}
