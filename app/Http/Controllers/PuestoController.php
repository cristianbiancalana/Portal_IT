<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puesto;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class PuestoController extends Controller
{
    public function index()
    {
        if (!Auth::user()->hasPermissionTo('puestos.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $puestos= Puesto::paginate(5);
        return view('portal_it.layouts.index', array('puestos'=>$puestos));
    }
    public function indextabla()
    {
        if (!Auth::user()->hasPermissionTo('puestos.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $puestos= Puesto::all();
        return view('portal_it.layouts.puestos', array('puestos'=>$puestos));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {     
        if (!Auth::user()->hasPermissionTo('puestos.create')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.puestos');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {     
        if (!Auth::user()->hasPermissionTo('puestos.store')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $request->validate([
            'name_puesto'=>['required','min:4'],
        ]);
         // Creación de una nueva instancia de Gerencia con los datos del formulario
        $puesto = new Puesto();
        $puesto->name_puesto= $request->input('name_puesto');
     
        
        // Guardar la nueva instancia en la base de datos
        $puesto->save();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('vistapuestos')->with('status', 'Puesto creado exitosamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(Puesto $puesto)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Puesto $puesto)
    {
        if (!Auth::user()->hasPermissionTo('puestos.edit')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.edit_puestos', ['puesto'=>$puesto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Puesto $puesto)
    {   
        if (!Auth::user()->hasPermissionTo('puestos.update')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $validated= $request->validate([
            'name_puesto'=>['required','min:4'],
        ]);
        
        
        $puesto->update($validated);
        $puestos = puesto::all();
        return redirect()->route('vistapuestos')->with('status', 'Puesto Actualizado');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Puesto $puesto)
    {
        if (!Auth::user()->hasPermissionTo('puestos.delete')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $puesto->delete();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('vistapuestos')->with('warning', 'Puesto eliminado');
    }
    public function mostrarTablaPuestos(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('puestos.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $puestos = Puesto::all();
        return view('portal_it.layouts.puestos',compact('puestos'));
    }
}
