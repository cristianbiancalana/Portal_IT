<?php

namespace App\Http\Controllers;

use App\Models\TypeResource;
use Illuminate\Http\Request;
use App\Models\Recurso;

class RecursoController extends Controller
{
    public function create()
    {
        $tiposderecursos = TypeResource::all();
        return view('portal_it.layouts.newresource', compact('tiposderecursos'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'tipo_recurso' => 'required',
            'fecha_alta' => 'required|date',
            'details' => 'required|json',
            'comentario' => 'nullable|string',
        ]);

        // Decodificar los detalles
        $details = json_decode($request->details, true);

        // Crear el recurso
        $recurso = new Recurso([
            'tipo_recurso' => $request->tipo_recurso,
            'fecha_alta' => $request->fecha_alta,
            'details' => $details,
            'comentario' => $request->comentario_ticket,
        ]);

        $recurso->save();

        return redirect()->route('recurso.create')->with('status', 'Recurso creado exitosamente');
    }
}
