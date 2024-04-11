<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sistema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class SistemaController extends Controller
{
    public function indextabla()
    {
        if (!Auth::user()->hasPermissionTo('sistemas.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $sistemas= Sistema::paginate(5);
        return view('portal_it.layouts.sistemas', array('sistemas'=>$sistemas));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        if (!Auth::user()->hasPermissionTo('sistemas.create')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
       return view('portal_it.layouts.sistemas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {     
        if (!Auth::user()->hasPermissionTo('sistemas.store')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $request->validate([
            'name_sistema'=>['required','min:4'],
        ]);
         // Creación de una nueva instancia de Gerencia con los datos del formulario
        $sistema = new Sistema();
        $sistema->name_sistema= $request->input('name_sistema');
     
        
        // Guardar la nueva instancia en la base de datos
        $sistema->save();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('vistasistemas')->with('status', 'Sistema creado exitosamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(Sistema $sistema)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sistema $sistema)
    {
        if (!Auth::user()->hasPermissionTo('sistemas.edit')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.edit_sistemas', ['sistema'=>$sistema]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sistema $sistema)
    {   
        if (!Auth::user()->hasPermissionTo('sistemas.update')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $validated= $request->validate([
            'name_sistema'=>['required','min:4'],
        ]);
        
        
        $sistema->update($validated);
        $sistemas = Sistema::all();
        return redirect()->route('vistasistemas')->with('status', 'Sistema Actualizado');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sistema $sistema)
    {
        if (!Auth::user()->hasPermissionTo('sistemas.delete')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $sistema->delete();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('vistasistemas')->with('warning', 'Sistema eliminado');
    }
    public function mostrarTablaSistemas(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('sistemas.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $sistemas = Sistema::all();
        return view('portal_it.layouts.sistemas',compact('sistemas'));
    }
}
