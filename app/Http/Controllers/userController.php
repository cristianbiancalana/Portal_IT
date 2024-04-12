<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Gerencia;
use App\Models\Puesto;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class userController extends Controller
{
    public function index()
    {
        
        if (!Auth::user()->hasPermissionTo('usuarios.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        
        $users= User::paginate(5);
        $gerencias = Gerencia::all();
        $puestos = Puesto::all();
        $roles = Role::all();
        return view('portal_it.layouts.usuarios', [
            
            'users'=>$users,
            'gerencias'=>$gerencias,
            'puestos'=> $puestos,
            'roles'=>$roles
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('usuarios.create')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $gerencias = Gerencia::all();
        $puestos = Puesto::all();

     
        return view('portal_it.layouts.usuarios') ->with([
            'puestos' => $puestos,
            'gerencias' => $gerencias
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('usuarios.store')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $request->validate([
            'name'=>['required','min:10'],
            'gerencia'=>['required','min:5'],
            'puesto'=>['required','min:4'],
            'email'=>['required','min:10'],
            'password'=>['required','min:8','confirmed']
        ]);
         // Creación de una nueva instancia de Gerencia con los datos del formulario
        
        $user = new User();
        $user->name= $request->input('name');
        $user->gerencia= $request->input('gerencia');
        $user->puesto= $request->input('puesto');
        $user->email= $request->input('email');
        $user->password= $request->input('password');     
        
        // Guardar la nueva instancia en la base de datos
       

        $user->save();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('usuarios')->with('status', 'Usuario creado exitosamente'); 
        
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (!Auth::user()->hasPermissionTo('usuarios.show')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.usuario_visualizar',['user'=> $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {    
        if (!Auth::user()->hasPermissionTo('usuarios.edit')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $gerencias = Gerencia::all();
        $puestos = Puesto::all();
        $roles = Role::all();
        return view('portal_it.layouts.editar-usuario',['user'=> $user])->with([
            'puestos' => $puestos,
            'gerencias' => $gerencias,
            'roles' => $roles
        
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {   
        if (!Auth::user()->hasPermissionTo('usuarios.update')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $nombre = $user->name;
        $correo = $user->email;
        $gerencia = $user->gerencia;
        $puesto = $user->puesto;
        $userId = $user->id;
        $roleId = $request->input('role_id');



        if($nombre!=null && $correo!=null && $gerencia!=null && $puesto!=null && $roleId!=null){
            if($request->name!=$nombre || $request->email!=$correo || $request->gerencia!=$gerencia || $request->puesto!=$puesto){
                $validated= $request->validate([
                    'name'=>['required','min:3'],
                    'email'=>['required','min:3','email'],
                    'gerencia'=>['nullable','string','min:3'],
                    'puesto'=>['nullable','string','min:3'],
                    'role_id'=>['required']
                ]);}
        }

        // Obtener el usuario de la base de datos
        $user = User::find($userId);

        // Obtener el rol correspondiente al ID
        $role = Role::find($roleId);

        // Quitar todos los roles existentes del usuario
        $user->syncRoles([]);

        // Asignar el nuevo rol al usuario
        $user->assignRole($role);

        // Actualizar los datos del usuario en la base de datos
        $user->update($validated);
        
        return redirect()->route('usuarios')->with('status', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (!Auth::user()->hasPermissionTo('usuarios.delete')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $user->delete();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('usuarios')->with('warning', 'Proveedor eliminado');
    }

    public function mostrarTablaUsuarios(Request $request)
    {
        
        if (!Auth::user()->hasPermissionTo('usuarios.index')) {
            
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $usuarios = User::all();
        $gerencias = Gerencia::all();
        $puestos = Puesto::all();
        return view('portal_it.layouts.usuarios',compact('usuarios','gerencias','puestos'));
    }

    public function assignRole(Request $request) 
    {
        if (!Auth::user()->hasPermissionTo('usuarios.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $userId = $request->input('user_id');
        $roleId = $request->input('role_id');

        $user = User::find($userId);
        $role = Role::find($roleId);

        if (!$user || !$role) {
            return redirect()->route('user.edit')->with('error', 'No se pudo asignar el rol');
        }

        $roles = $user->getRoleNames(); // Obtener los nombres de los roles del usuario

        foreach ($roles as $rol) {
            $user->removeRole($rol); // Quitar cada rol que tenga el usuario
        }

        $user->assignRole($role); // Asignar el nuevo rol al usuario

        return redirect()->route('usuarios')->with('success', 'Rol asignado exitosamente');
    }


}

    

