<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // obteniendo los roles
        $roles = Role::all();
        return Inertia::render("Components/Roles",['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // obteniendo la data de request
        $data = $request->input();
        
        // agregando el permiso al rol
        DB::table('role_has_permissions')->insert([
            'permission_id' => $data['permission_id'],
            'role_id' => $data['role_id']
        ]);
        return Redirect::route('roles.index');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // obteniendo los permisos de rol seleccionado
        $permisosUser = DB::table('role_has_permissions')
        ->select('permissions.id as ident', 'permissions.name as permiso', 'role_has_permissions.role_id as idrols')
        ->join('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
        ->where('role_has_permissions.role_id', '=', $id)
        ->orderBy('permissions.id', 'asc')
        ->get();
        // obteniendo todos los permisos
        $permisos = DB::table('permissions')
        ->select('permissions.id as ident', 'permissions.name as permiso')
        ->whereNotIn('permissions.name', DB::table('permissions')
        ->select('permissions.name')
        ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
        ->join('roles', 'roles.id', '=', 'role_has_permissions.role_id')
        ->where('role_id', '=', $id))
        ->get();

        return Inertia::render("Components/FormRol",['permisosUser' => $permisosUser, 'permisos' => $permisos, 'idrol' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($data)
    {
        // validando si existe un encargado activo antes de activar otro
        $rol = DB::table('role_has_permissions')->where('permissions_id', '=', $data->ident)
        ->where('role_id', '=', $data->idrols)
        ->get()->first();
        $rol->delete();
    }
}
