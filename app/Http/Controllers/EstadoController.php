<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class EstadoController extends Controller
{
    public function index()
    {
        if (!Auth::user()->hasPermissionTo('estados.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $estados= Estado::paginate(5);
        return view('portal_it.layouts.index', array('estados'=>$estados));
    }
    public function indextabla()
    {
        if (!Auth::user()->hasPermissionTo('estados.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $estados= Estado::all();
        return view('portal_it.layouts.estados', array('estados'=>$estados));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {     
        if (!Auth::user()->hasPermissionTo('estados.create')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }    
        return view('portal_it.layouts.estados');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {     
        if (!Auth::user()->hasPermissionTo('estados.store')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $request->validate([
            'name_estados'=>['required','min:4'],
        ]);
         // Creación de una nueva instancia de Gerencia con los datos del formulario
        $estado = new Estado();
        $estado->name_estados= $request->input('name_estados');
     
        
        // Guardar la nueva instancia en la base de datos
        $estado->save();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('vistaestados')->with('status', 'Estado creado exitosamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(Estado $estado)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estado $estado)
    {
        if (!Auth::user()->hasPermissionTo('estados.edit')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.edit_estados', ['estado'=>$estado]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estado $estado)
    {   
        if (!Auth::user()->hasPermissionTo('estados.update')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $validated= $request->validate([
            'name_estados'=>['required','min:4'],
        ]);
        
        
        $estado->update($validated);
        $estados = Estado::all();
        return redirect()->route('vistaestados')->with('status', 'Estado Actualizado');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estado $estado)
    {
        if (!Auth::user()->hasPermissionTo('estados.delete')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $estado->delete();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('vistaestados')->with('warning', 'Estado eliminado');
    }
    public function mostrarTablaEstados(Request $request)
    {
        $estados = Estado::paginate(5);

                    // Retornas la tabla construida
        return view('portal_it.layouts.estados',compact('estados'));
    }
}
