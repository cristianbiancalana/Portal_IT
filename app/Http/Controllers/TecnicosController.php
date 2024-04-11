<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tecnico;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class TecnicosController extends Controller
{
    public function index()
    {
        if (!Auth::user()->hasPermissionTo('tecnicos.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $tecnicos= Tecnico::paginate(5);
        return view('portal_it.layouts.index', array('tecnicos'=>$tecnicos));
    }
    public function indextabla()
    {
        if (!Auth::user()->hasPermissionTo('tecnicos.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $tecnicos= Tecnico::all();
        return view('portal_it.layouts.tecnicos', array('tecnicos'=>$tecnicos));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        if (!Auth::user()->hasPermissionTo('tecnicos.create')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.tecnicos');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {     
        if (!Auth::user()->hasPermissionTo('tecnicos.store')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $request->validate([
            'name_tecnicos'=>['required','min:4'],
            'tel_tecnicos'=>['required','min:4'],
            'email_tecnicos'=>['required','min:4']
        ]);
         // Creación de una nueva instancia de Gerencia con los datos del formulario
        $tecnico = new Tecnico();
        $tecnico->name_tecnicos= $request->input('name_tecnicos');
        $tecnico->tel_tecnicos= $request->input('tel_tecnicos');
        $tecnico->email_tecnicos= $request->input('email_tecnicos');
     
        
        // Guardar la nueva instancia en la base de datos
        $tecnico->save();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('vistatecnicos')->with('status', 'Tecnicos creado exitosamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(Tecnico $tecnico)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tecnico $tecnico)
    {
        if (!Auth::user()->hasPermissionTo('tecnicos.edit')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.edit_tecnicos', ['tecnico'=>$tecnico]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tecnico $tecnico)
    {   
        if (!Auth::user()->hasPermissionTo('tecnicos.update')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $validated= $request->validate([
            'name_tecnicos'=>['required','min:4'],
            'tel_tecnicos'=>['required','min:4'],
            'email_tecnicos'=>['required','min:4']
        ]);
        
        
        $tecnico->update($validated);
        $tecnicos = Tecnico::all();
        return redirect()->route('vistatecnicos')->with('status', 'Técnico Actualizado');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tecnico $tecnico)
    {
        if (!Auth::user()->hasPermissionTo('tecnicos.delete')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $tecnico->delete();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('vistatecnicos')->with('warning', 'Técnico eliminado');
    }
    public function mostrarTablaTecnicos(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('tecnicos.index')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $tecnicos = Tecnico::all();
        return view('portal_it.layouts.tecnicos',compact('tecnicos'));
    }
}
