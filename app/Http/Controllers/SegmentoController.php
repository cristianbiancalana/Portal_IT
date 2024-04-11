<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Segmento;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class SegmentoController extends Controller
{
    public function indextabla()
    {
        if (!Auth::user()->hasPermissionTo('segmentos.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $segmentos= Segmento::paginate(5);
        return view('portal_it.layouts.segmentos', array('segmentos'=>$segmentos));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {     
        if (!Auth::user()->hasPermissionTo('segmentos.create')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.segmentos');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {     
        if (!Auth::user()->hasPermissionTo('segmentos.store')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $request->validate([
            'name_segmento'=>['required','min:4'],
        ]);
         // Creación de una nueva instancia de Gerencia con los datos del formulario
        $segmento = new Segmento();
        $segmento->name_segmento= $request->input('name_segmento');
     
        
        // Guardar la nueva instancia en la base de datos
        $segmento->save();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('vistasegmentos')->with('status', 'Puesto creado exitosamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(Segmento $segmento)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Segmento $segmento)
    {
        if (!Auth::user()->hasPermissionTo('segmentos.edit')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.edit_segmentos', ['segmento'=>$segmento]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Segmento $segmento)
    {   
        if (!Auth::user()->hasPermissionTo('segmentos.update')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $validated= $request->validate([
            'name_segmento'=>['required','min:4'],
        ]);
        
        
        $segmento->update($validated);
        $segmentos = Segmento::all();
        return redirect()->route('vistasegmentos')->with('status', 'Segmento Actualizado');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Segmento $segmento)
    {
        if (!Auth::user()->hasPermissionTo('segmentos.delete')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $segmento->delete();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('vistasegmentos')->with('warning', 'Segmento eliminado');
    }
    public function mostrarTablaSegmentos(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('segmentos.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $segmentos = Segmento::all();
        return view('portal_it.layouts.segmentos',compact('segmentos'));
    }
}
