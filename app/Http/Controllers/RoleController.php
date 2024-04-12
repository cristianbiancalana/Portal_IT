<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{

    public function index()
    {
        if (!Auth::user()->hasPermissionTo('roles.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $roles = Role::all();
        return view('portal_it.layouts.rolesview', ['roles' => $roles]);
    }
    public function indextabla()
    {
        if (!Auth::user()->hasPermissionTo('roles.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $roles= Role::all();
        return view('portal_it.layouts.rolesview', array('roles'=>$roles));
    }

    public function create()
    {     
        if (!Auth::user()->hasPermissionTo('roles.create')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.rolesview');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {     
        if (!Auth::user()->hasPermissionTo('roles.store')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }

        
        $request->validate([
            'name'=>['required','min:3'],
            'guard_name'=>['nullable']
        ]);

       
         // Creación de una nueva instancia de Gerencia con los datos del formulario
        $role = new Role();
        $role->name=$request->input('name');
        $role->guard_name=$request->input('guard_name');
        
        // Guardar la nueva instancia en la base de datos
        $role->save();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('roles')->with('status', 'Rol creado exitosamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        if (!Auth::user()->hasPermissionTo('roles.show')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.visualizar',['role'=> $role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        if (!Auth::user()->hasPermissionTo('roles.edit')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }

         // Crear un array con los permisos que deseas verificar
        $permisos_a_verificar = [
            'usuarios.index',
            'usuarios.create',
            'usuarios.store',
            'usuarios.edit',
            'usuarios.update',
            // Añade más permisos según lo necesites
        ];
        
        // Crear un array para almacenar los permisos asignados al rol
        $permisos_asignados = [];
        
        // Verificar cada permiso si está asignado al rol
        foreach ($permisos_a_verificar as $permiso) {
            if ($role->hasPermissionTo($permiso)) {
                $permisos_asignados[$permiso] = true;
            } else {
                $permisos_asignados[$permiso] = false;
            }
        }
        
        // Pasar el rol y los permisos asignados a la vista
        return view('portal_it.layouts.edit_roles', [
            'role' => $role,
            'permisos_asignados' => $permisos_asignados,
        ]);
            
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {   
        if (!Auth::user()->hasPermissionTo('roles.update')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        
        $validated= $request->validate([
            'name'=>['required','min:3'],
        ]);
        
        
        $role->update($validated);
        
        if ($request->has('permisos')) {
            $role->syncPermissions($request->input('permisos'));
        }
        return redirect()->route('rolesview')->with('status', 'Rol Actualizado');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if (!Auth::user()->hasPermissionTo('roles.delete')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $role->delete();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('rolesview')->with('warning', 'Rol eliminado');
    }
    public function mostrarTablaRoles(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('roles.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $roles = Role::all();
        return view('portal_it.layouts.rolesview',compact('roles'));
    }


}

// public function assignRole(Request $request){
    //     if (!Auth::user()->hasPermissionTo('tickets.index')) {
    //         return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
    //     }
    //         $userId = $request->input('user_id');
    //         $roleId = $request->input('role_id');

    //         $user = User::find($userId);
    //         $role = Role::find($roleId);

    //         if (!$user || !$role) {
    //             return redirect()->route('asignar-rol')->with('error', 'No se pudo asignar el rol');
    //         }

    //         $roles = $user->getRoleNames(); // Obtener los nombres de los roles del usuario

    //         foreach ($roles as $rol) {
    //             $user->removeRole($rol); // Quitar cada rol que tenga el usuario
    //         }

    //         $user->assignRole($role); // Asignar el nuevo rol al usuario

    //         return redirect()->route('asignar-rol')->with('success', 'Rol asignado exitosamente');
    //     }

    //     public function create(){     
            
    //     return view('portal_it.layouts.rolesview');
    //     }

