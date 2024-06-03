<?php

namespace App\Http\Controllers;

use App\Models\TypeResource;
use Illuminate\Http\Request;
use App\Models\Recurso;

class RecursoController extends Controller
{
    public function index()
    {
        // if (!Auth::user()->hasPermissionTo('problemas.index')) {
        //     return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        // }
        $recursos= Recurso::all();
        return view('portal_it.layouts.index_resource', array('recursos'=>$recursos));
    }
    public function create()
    {
        $tiposderecursos = TypeResource::all();
        return view('portal_it.layouts.newresource', compact('tiposderecursos'));
    }
    public function store(Request $request)
{
    // Mostrar los datos recibidos para depuración
    // dd($request->all());

    // Validación de los datos del request
    $validatedData = $request->validate([
        'tipo_recurso' => 'required|string|max:255',
        'tag'=> 'required|max:100',
        'fecha_alta' => 'required|date',
        'marca'=> 'required|max:100',
        'modelo' => 'required|max:100',
        'serie'=> 'required|max:30',
        'details' => 'nullable|string', // Validamos como string ya que es JSON
        'comentario' => 'nullable|string',
    ]);

    // Decodificar los detalles en un array
    $details = json_decode($request->input('details'), true);

    // Verificar si hay errores en la decodificación del JSON
    if (json_last_error() !== JSON_ERROR_NONE) {
        return redirect()->back()->withErrors(['details' => 'Invalid JSON in details field'])->withInput();
    }

    // Crear un nuevo recurso
    $recurso = new Recurso();
    $recurso->tipo_recurso = $validatedData['tipo_recurso'];
    $recurso->tag = $validatedData['tag'];
    $recurso->fecha_alta = $validatedData['fecha_alta'];
    $recurso->marca = $validatedData['marca'];
    $recurso->modelo = $validatedData['modelo'];
    $recurso->serie = $validatedData['serie'];
    $recurso->details = $details; // Guardar el array decodificado
    $recurso->comentario = $validatedData['comentario'] ?? '';

    $recurso->save();

    return redirect()->route('recurso.create')->with('status', 'Recurso creado exitosamente');
}


}
