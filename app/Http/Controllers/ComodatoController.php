<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comodato;
use App\Models\User;
use App\Models\Puesto;
use App\Models\TypeResource;
use App\Models\Recurso;

class ComodatoController extends Controller
{
    public function index()
    {       
        $comodatos = Comodato::all();
        return view('portal_it.layouts.index_comodatos', compact('comodatos'));
    }

    public function create(){
        $users = User::all();
        $puestos = Puesto::all();
        $tiposderecuros = TypeResource::all();
        $recursos = Recurso::all();
        return view('portal_it.layouts.newcomodato', compact('users','puestos','tiposderecuros','recursos'));
    }
    public function searchResource(Request $request)
    {
        $query = $request->get('query');
        $resource = Recurso::where('serie', 'like', '%' . $query . '%')->first();

        if ($resource) {
            return response()->json(['success' => true, 'resource' => $resource]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function store(Request $request){
        $request->validate([
            'user' => 'required|string|max:90',
            'puesto' => 'required|string|max:70',
            'tipo_recurso' => 'required|string|max:40',
            'fecha_alta' => 'required|date',
            'marca' => 'required|string|max:30',
            'modelo' => 'required|string|max:60',
            'serie' => 'required|unique:comodatos,serie|max:30',
            'details' => 'nullable|string',
            'observacion' => 'nullable|string|max:150',
        ]);

        // Busca el recurso por serie
        $recurso = Recurso::where('serie', 'like', '%' . $request->serie . '%')->first();

        // Obtén los detalles del recurso si existe
        $details = $recurso ? $recurso->details : null;

        // Convierte los detalles a JSON si no están ya en formato JSON
        if (is_array($details) || is_object($details)) {
            $details = json_encode($details);
        }

        $comodato = new Comodato();
        $comodato->fecha_alta = $request->input('fecha_alta');
        $comodato->user = $request->input('user');
        $comodato->puesto = $request->input('puesto');
        $comodato->tipo_recurso = $request->input('tipo_recurso');
        $comodato->marca = $request->input('marca');
        $comodato->modelo = $request->input('modelo');
        $comodato->serie = $request->input('serie');
        $comodato->detalles = $details; // Almacena los detalles en JSON
        $comodato->observacion = $request->input('observacion');

        $comodato->save();
        return redirect()->route('comodato.index')->with('status', 'Comodato creado exitosamente');
    }
}
