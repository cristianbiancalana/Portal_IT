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
    //     if (!Auth::user()->hasPermissionTo('roles.index')) {
    //         return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
    //     }
        $roles = Role::all();
        return view('portal_it.layouts.rolesview', ['roles' => $roles]);
    }
    public function indextabla()
    {
        // if (!Auth::user()->hasPermissionTo('roles.index')) {
        //     return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        // }
        $roles= Role::all();
        return view('portal_it.layouts.rolesview', array('roles'=>$roles));
    }

    public function create()
    {     
        // if (!Auth::user()->hasPermissionTo('roles.create')) {
        //     return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        // }
        return view('portal_it.layouts.rolesview');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {     
        // if (!Auth::user()->hasPermissionTo('roles.store')) {
        //     return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        // }

        
        $request->validate([
            'name'=>['required','min:3'],
            'guard_name'=>['nullable'],
            'permisos' => ['sometimes', 'array']

        ]);

       
         // Creación de una nueva instancia de Gerencia con los datos del formulario
        $role = new Role();
        $role->name=$request->input('name');
        $role->guard_name=$request->input('guard_name');
        
        // Guardar la nueva instancia en la base de datos
        $role->save();
        
        if ($request->has('permisos')) {
            // Asignar permisos al rol
            $permisos = $request->input('permisos');
            $role->syncPermissions($permisos);
        }
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('roles')->with('status', 'Rol creado exitosamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        // if (!Auth::user()->hasPermissionTo('roles.show')) {
        //     return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        // }
        return view('portal_it.layouts.visualizar',['role'=> $role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        // if (!Auth::user()->hasPermissionTo('roles.edit')) {
        //     return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        // }

         // Crear un array con los permisos que deseas verificar
        $permisos_a_verificar = [

            'usuarios.index',
            'usuarios.create',
            'usuarios.store',
            'usuarios.edit',
            'usuarios.update',
            'usuarios.show',

            'tickets.edit',
            'tickets.update',
            'tickets.create',
            'tickets.store',
            'tickets.index',
            'tickets.index.pendiente',
            'tickets.index.gerencia',
            'tickets.index.gerencia.pendientes',

            'puestos.edit',
            'puestos.update',
            'puestos.create',
            'puestos.store',
            'puestos.index',
            'puestos.delete',

            'gerencias.edit',
            'gerencias.update',
            'gerencias.create',
            'gerencias.store',
            'gerencias.index',
            'gerencias.show',       
            'gerencias.delete',

            'segmentos.edit',
            'segmentos.update',
            'segmentos.create',
            'segmentos.store',
            'segmentos.index',
            'segmentos.delete',

            'sistemas.edit',
            'sistemas.update',
            'sistemas.create',
            'sistemas.store',
            'sistemas.index',
            'sistemas.delete',

            'problemas.edit',
            'problemas.update',
            'problemas.create',
            'problemas.store',
            'problemas.index',
            'problemas.delete',

            'estados.edit',
            'estados.update',
            'estados.create',
            'estados.store',
            'estados.index',
            'estados.delete',

            'proveedores.edit',
            'proveedores.update',
            'proveedores.create',
            'proveedores.store',
            'proveedores.index',
            'proveedores.show',
            'proveedores.delete',

            'prioridades.edit',
            'prioridades.update',
            'prioridades.create',
            'prioridades.store',
            'prioridades.index',
            'prioridades.delete',

            'tecnicos.edit',
            'tecnicos.update',
            'tecnicos.create',
            'tecnicos.store',
            'tecnicos.index',
            'tecnicos.delete',

            'roles.edit',
            'roles.update',
            'roles.create',
            'roles.store',
            'roles.index',
            // Añade más permisos según lo necesites
        ];
        
        // Verifica los permisos asignados al rol
        $permisos_asignados = $this->verificarPermisos($role, $permisos_a_verificar);

        // Variables para manejar los permisos de usuarios, puestos y gerencias
        $usuarios_all_checked = $this->verificarPermisosGrupales($permisos_asignados, ['usuarios.index', 'usuarios.create', 'usuarios.store', 'usuarios.edit', 'usuarios.update', 'usuarios.show']);
        $puestos_all_checked = $this->verificarPermisosGrupales($permisos_asignados, ['puestos.index', 'puestos.create', 'puestos.edit', 'puestos.update', 'puestos.delete']);
        $gerencias_all_checked = $this->verificarPermisosGrupales($permisos_asignados, ['gerencias.index', 'gerencias.create', 'gerencias.edit', 'gerencias.update', 'gerencias.delete']);

        // Pasar el rol y los permisos asignados a la vista
        return view('portal_it.layouts.edit_roles', [
            'role' => $role,
            'permisos_asignados' => $permisos_asignados,
            'usuarios_all_checked' => $usuarios_all_checked,
            'puestos_all_checked' => $puestos_all_checked,
            'gerencias_all_checked' => $gerencias_all_checked
        ]);
    }

    private function verificarPermisos(Role $role, array $permisos_a_verificar)
    {
        $permisos_asignados = [];
        foreach ($permisos_a_verificar as $permiso) {
            $permisos_asignados[$permiso] = $role->hasPermissionTo($permiso);
        }
        return $permisos_asignados;
    }

    private function verificarPermisosGrupales($permisos_asignados, array $grupo_permisos)
    {
        foreach ($grupo_permisos as $permiso) {
            if (!isset($permisos_asignados[$permiso]) || !$permisos_asignados[$permiso]) {
                return false;
            }
        }
        return true;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {   
        // if (!Auth::user()->hasPermissionTo('roles.update')) {
        //     return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        // }
        
        $validated= $request->validate([
            'name'=>['nullable','min:3'],
        ]);
        
        
        
        // Actualizar el nombre del rol
        $role->update($validated);

        if ($request->has('permisos')) {
            // Obtener los permisos seleccionados en el formulario
            $selectedPermissions = $request->input('permisos');
            // Actualizar permisos
            $role->syncPermissions($selectedPermissions);
        }
        return redirect()->route('roles')->with('status', 'Rol Actualizado');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // if (!Auth::user()->hasPermissionTo('roles.delete')) {
        //     return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        // }
        $role->delete();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('rolesview')->with('warning', 'Rol eliminado');
    }
    public function mostrarTablaRoles(Request $request)
    {
        // if (!Auth::user()->hasPermissionTo('roles.index')) {
        //     return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        // }
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

