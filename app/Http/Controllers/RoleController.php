<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
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
        ]);
         // Creación de una nueva instancia de Gerencia con los datos del formulario
        $role = new Role();
        $role->name_role=$request->input('name_role');
     
        
        // Guardar la nueva instancia en la base de datos
        $role->save();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('rolesview')->with('status', 'Rol creado exitosamente');
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
        return view('portal_it.layouts.edit_role', ['role'=>$role]);
        
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
        $role = Role::all();
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

