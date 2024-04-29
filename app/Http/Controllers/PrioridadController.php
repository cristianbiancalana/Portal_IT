<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prioridad;
use Illuminate\Support\Facades\Auth;

class PrioridadController extends Controller
{
    public function index()
    {
        if (!Auth::user()->hasPermissionTo('prioridades.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $prioridades= Prioridad::paginate(5);
        return view('portal_it.layouts.index', array('prioridades'=>$prioridades));
    }
    public function indextabla()
    {
        if (!Auth::user()->hasPermissionTo('prioridades.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $prioridades= Prioridad::all();
        return view('portal_it.layouts.prioridades', array('prioridades'=>$prioridades));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {     
        if (!Auth::user()->hasPermissionTo('prioridades.create')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.prioridades');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {     
        if (!Auth::user()->hasPermissionTo('prioridades.store')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $request->validate([
            'name_prioridades'=>['required','min:4'],
        ]);
         // Creación de una nueva instancia de Gerencia con los datos del formulario
        $prioridad = new Prioridad();
        $prioridad->name_prioridades= $request->input('name_prioridades');
     
        
        // Guardar la nueva instancia en la base de datos
        $prioridad->save();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('vistaprioridades')->with('status', 'Prioridad creado exitosamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(Prioridad $prioridad)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prioridad $prioridad)
    {
        if (!Auth::user()->hasPermissionTo('prioridades.edit')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.edit_prioridades', ['prioridad'=>$prioridad]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prioridad $prioridad)
    {   
        if (!Auth::user()->hasPermissionTo('prioridades.update')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $validated= $request->validate([
            'name_prioridades'=>['required','min:4'],
        ]);
        
        
        $prioridad->update($validated);
        $prioridades = Prioridad::all();
        return redirect()->route('vistaprioridades')->with('status', 'Prioridad Actualizada');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prioridad $prioridad)
    {
        if (!Auth::user()->hasPermissionTo('prioridades.delete')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $prioridad->delete();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('vistaprioridades')->with('warning', 'Prioridad eliminada');
    }
    public function mostrarTablaPrioridades(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('prioridades.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $prioridades = Prioridad::paginate(5); 
        return view('portal_it.layouts.prioridades',compact('prioridades'));
    }
}
