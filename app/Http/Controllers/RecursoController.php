<?php

namespace App\Http\Controllers;

use App\Models\TypeResource;
use Illuminate\Http\Request;
use App\Models\Recurso;

class RecursoController extends Controller
{
    public function create()
    {
        $tiposderecursos = ['Notebook', 'Impresora', 'Celular', 'Tablet', 'PC de Escritorio', 'Perifericos', 'Monitor', 'Servidor', 'Cámara de Seguridad', 'NVR', 'Access Point', 'Accesorios', 'Dispositivos', 'Herramientas', 'Televisores', 'Insumos'];
        return view('portal_it.layouts.newresource', compact('tiposderecursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_recurso' => 'required|string',
            'detalles' => 'required|array',
            'comentario' => 'nullable|string',
        ]);

        Recurso::create([
            'tipo_recurso' => $request->tipo_recurso,
            'detalles' => $request->detalles,
            'comentario' => $request->comentario,
        ]);

        return redirect()->back()->with('status', 'Recurso creado exitosamente');
    }
}
