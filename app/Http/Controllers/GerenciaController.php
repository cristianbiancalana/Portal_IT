<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gerencia;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class GerenciaController extends Controller
{
    public function index()
    {
        if (!Auth::user()->hasPermissionTo('gerencias.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $gerencias= Gerencia::paginate(5);
        return view('portal_it.layouts.index', array('gerencias'=>$gerencias));
    }
    public function indextabla()
    {
        if (!Auth::user()->hasPermissionTo('gerencias.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $gerencias= Gerencia::paginate(5);
        return view('portal_it.layouts.gerencias', array('gerencias'=>$gerencias));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {     
        if (!Auth::user()->hasPermissionTo('gerencias.create')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.gerencias');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {     
        if (!Auth::user()->hasPermissionTo('gerencias.store')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $request->validate([
            'nombre_gerencia'=>['required','min:7'],
            'gerente_acargo'=>['required','min:7']
        ]);
         // Creación de una nueva instancia de Gerencia con los datos del formulario
        $gerencia = new Gerencia();
        $gerencia->nombre_gerencia= $request->input('nombre_gerencia');
        $gerencia->gerente_acargo= $request->input('gerente_acargo');
        
        // Guardar la nueva instancia en la base de datos
        $gerencia->save();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('vistagerencias')->with('status', 'Gerencia Creada exitosamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(Gerencia $gerencia)
    {
        if (!Auth::user()->hasPermissionTo('gerencia.show')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.visualizar',['gerencia'=> $gerencia]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gerencia $gerencia)
    {
        if (!Auth::user()->hasPermissionTo('gerencias.edit')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.edit_gerencia', ['gerencia'=>$gerencia]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gerencia $gerencia)
    {   
        if (!Auth::user()->hasPermissionTo('gerencias.update')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $validated= $request->validate([
            'nombre_gerencia'=>['required','min:7'],
            'gerente_acargo'=>['required','min:7']
        ]);
        
        
        $gerencia->update($validated);
        $gerencias = Gerencia::all();
        return redirect()->route('vistagerencias')->with('status', 'Gerencia Actualizada');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gerencia $gerencia)
    {
        if (!Auth::user()->hasPermissionTo('gerencias.delete')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $gerencia->delete();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('vistagerencias')->with('warning', 'Gerencia eliminada exitosamente');
    }
    public function mostrarTablaGerencias(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('gerencias.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $gerencias = Gerencia::paginate(5);
   

                    // Retornas la tabla construida
        return view('portal_it.layouts.gerencias',compact('gerencias'));
    }
}
