<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Problema;
use Illuminate\Support\Facades\Auth;

class ProblemasController extends Controller
{
    public function index()
    {
        if (!Auth::user()->hasPermissionTo('problemas.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $problemas= Problema::paginate(5);
        return view('portal_it.layouts.index', array('problemas'=>$problemas));
    }
    public function indextabla()
    {
        if (!Auth::user()->hasPermissionTo('problemas.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $problemas= Problema::paginate(5);
        return view('portal_it.layouts.problemas', array('problemas'=>$problemas));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {     
        if (!Auth::user()->hasPermissionTo('problemas.create')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.problemas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {     
        if (!Auth::user()->hasPermissionTo('problemas.store')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $request->validate([
            'name_problema'=>['required','min:4'],
        ]);
         // Creación de una nueva instancia de Gerencia con los datos del formulario
        $problema = new Problema();
        $problema->name_problema= $request->input('name_problema');
     
        
        // Guardar la nueva instancia en la base de datos
        $problema->save();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('vistaproblemas')->with('status', 'Problema creado exitosamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(Problema $problema)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Problema $problema)
    {
        if (!Auth::user()->hasPermissionTo('problemas.edit')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.edit_problemas', ['problema'=>$problema]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Problema $problema)
    {   
        if (!Auth::user()->hasPermissionTo('problemas.update')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $validated= $request->validate([
            'name_problema'=>['required','min:4'],
        ]);
        
        
        $problema->update($validated);
        $problemas = Problema::all();
        return redirect()->route('vistaproblemas')->with('status', 'Problema Actualizado');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Problema $problema)
    {
        if (!Auth::user()->hasPermissionTo('problemas.delete')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $problema->delete();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('vistaproblemas')->with('warning', 'Problema eliminado');
    }
    public function mostrarTablaProblemas(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('problemas.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $problemas = Problema::paginate(5);
        return view('portal_it.layouts.problemas',compact('problemas'));
    }
}
