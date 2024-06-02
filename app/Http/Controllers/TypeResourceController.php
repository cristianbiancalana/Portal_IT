<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class TypeResourceController extends Controller
{
    public function index()
    {
        // if (!Auth::user()->hasPermissionTo('tiposderecursos.index')) {
        //     return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        // }
        $tiposderecursos= TypeResource::paginate(5);
        return view('portal_it.layouts.index', array('tiposderecursos'=>$tiposderecursos));
    }
    public function indextabla()
    {
        // if (!Auth::user()->hasPermissionTo('tiposderecursos.index')) {
        //     return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        // }
        $tiposderecursos= TypeResource::paginate(5);
        return view('portal_it.layouts.typeresource', array('tiposderecursos'=>$tiposderecursos));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {     
        // if (!Auth::user()->hasPermissionTo('tiposderecursos.create')) {
        //     return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        // }
        return view('portal_it.layouts.typeresource');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {     
        // if (!Auth::user()->hasPermissionTo('tiposderecursos.store')) {
        //     return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        // }
        $request->validate([
            'name_tiposderecursos'=>['required','min:3'],
        ]);
         // Creación de una nueva instancia de Gerencia con los datos del formulario
        $resourcer = new TypeResource();
        $resourcer->name_tiposderecursos= $request->input('name_tiposderecursos');
     
        
        // Guardar la nueva instancia en la base de datos
        $resourcer->save();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('vistatyperesource')->with('status', 'Recurso creado exitosamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(TypeResource $resourcer)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeResource $tiposderecurso)
    {
        // if (!Auth::user()->hasPermissionTo('tiposderecursos.edit')) {
        //     return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        // }
        return view('portal_it.layouts.edit_typeresource', ['tiposderecurso'=>$tiposderecurso]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeResource $tiposderecurso)
    {   
        // if (!Auth::user()->hasPermissionTo('tiposderecursos.update')) {
        //     return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        // }
        $validated= $request->validate([
            'name_tiposderecursos'=>['required','min:3'],
        ]);
        
        
        $tiposderecurso->update($validated);
        $tiposderecursos = TypeResource::all();
        return redirect()->route('vistatyperesource')->with('status', 'Recurso Actualizado');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeResource $tiposderecursos)
    {
        // if (!Auth::user()->hasPermissionTo('tiposderecursos.delete')) {
        //     return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        // }
        $tiposderecursos->delete();
        
        // Redireccionar con un mensaje de éxito
        return redirect()->route('vistatyperesource')->with('warning', 'Recurso eliminado');
    }
    public function mostrarTablaTypeResource(Request $request)
    {
        // if (!Auth::user()->hasPermissionTo('tiposderecursos.index')) {
        //     return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        // }
        $tiposderecursos = TypeResource::paginate(5); 
        return view('portal_it.layouts.typeresource',array('tiposderecursos'=>$tiposderecursos));
    }
}
