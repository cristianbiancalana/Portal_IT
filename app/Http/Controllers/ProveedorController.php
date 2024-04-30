<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;


class ProveedorController extends Controller
{
    public function index()
    {
        if (!Auth::user()->hasPermissionTo('proveedores.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $proveedores= Proveedor::paginate(5);
        return view('portal_it.layouts.index', array('proveedores'=>$proveedores));
    }
    public function indextabla()
    {
        if (!Auth::user()->hasPermissionTo('proveedores.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $proveedores= Proveedor::paginate(5);
        return view('portal_it.layouts.proveedores', array('proveedores'=>$proveedores));
    }

    

    public function create()
    {     
        if (!Auth::user()->hasPermissionTo('proveedores.create')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.proveedores');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {     
        if (!Auth::user()->hasPermissionTo('proveedores.store')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $request->validate([
            'name_proveedor'=>['required','min:4'],
            'contacto1_proveedor'=>['required','min:4'],
            'tel1_proveedor'=>['required','min:4'],
            'contacto2_proveedor'=>['required','min:4'],
            'tel2_proveedor'=>['required','min:4'],
            'comentario'=>['required','min:4']
        ]);
         // Creación de una nueva instancia de Gerencia con los datos del formulario
        $proveedor = new Proveedor();
        $proveedor->name_proveedor= $request->input('name_proveedor');
        $proveedor->contacto1_proveedor= $request->input('contacto1_proveedor');
        $proveedor->tel1_proveedor= $request->input('tel1_proveedor');
        $proveedor->contacto2_proveedor= $request->input('contacto2_proveedor');
        $proveedor->tel2_proveedor= $request->input('tel2_proveedor');
        $proveedor->comentario= $request->input('comentario');
     
        
        // Guardar la nueva instancia en la base de datos
        $proveedor->save();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('vistaproveedores')->with('status', 'Proveedor creado exitosamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        if (!Auth::user()->hasPermissionTo('proveedores.show')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.proveedor_visualizar',['proveedor'=> $proveedor]);
    }

    public function edit(Proveedor $proveedor)
    {
        if (!Auth::user()->hasPermissionTo('proveedores.edit')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.edit_proveedores', ['proveedor'=>$proveedor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedor $proveedor)
    {   
        if (!Auth::user()->hasPermissionTo('proveedores.update')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $validated= $request->validate([
            'name_proveedor'=>['required','min:4'],
            'contacto1_proveedor'=>['required','min:4'],
            'tel1_proveedor'=>['required','min:4'],
            'contacto2_proveedor'=>['required','min:4'],
            'tel2_proveedor'=>['required','min:4'],
            'comentario'=>['required','min:4']
        ]);
        
        
        $proveedor->update($validated);
        $proveedores = Proveedor::all();
        return redirect()->route('vistaproveedores')->with('status', 'Proveedor Actualizado');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        if (!Auth::user()->hasPermissionTo('proveedores.delete')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $proveedor->delete();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('vistaproveedores')->with('warning', 'Proveedor eliminado');
    }
    public function mostrarTablaProveedores(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('proveedores.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $proveedores = Proveedor::paginate(5);
        return view('portal_it.layouts.proveedores',compact('proveedores'));
    }
}
