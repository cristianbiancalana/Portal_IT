<?php

namespace App\Http\Controllers;

use App\Models\TypeResource;
use Illuminate\Http\Request;
use App\Models\Recurso;
use League\CommonMark\Extension\Attributes\Node\Attributes;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Exception;
use Attribute;
use Illuminate\Pagination\Paginator;
use PhpParser\Node\AttributeGroup;

class RecursoController extends Controller
{
    public function index()
    {       
            $recursos = Recurso::paginate(10);
            return view('portal_it.layouts.index_resource', compact('recursos'));
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
        'serie'=> 'unique:recursos,serie|required|max:30',
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

public function registerHardwareAutomatically()
    {
        try {
            $hardwareInfo = $this->getHardwareInfo();

            $filteredInfo = [
                'cpu' => $hardwareInfo['cpu'],
                'memory' => $hardwareInfo['memory'],
                'disk' => $hardwareInfo['disk'],
                'tag' => $hardwareInfo['tag'],
                'system' => $hardwareInfo['system'],
            ];

            // Verificar si el número de serie ya existe
            if (Recurso::where('serie', $hardwareInfo['system']['serial'])->exists()) {
                return response()->json(['status' => 'error', 'message' => 'El número de serie ya existe'], 400);
            }

            // Almacenar la información en la base de datos
            $recurso = new Recurso();
            $recurso->tipo_recurso = 'Notebook'; // Puedes ajustar esto según sea necesario
            $recurso->tag = $hardwareInfo['tag']['host']; 
            $recurso->fecha_alta = now();
            $recurso->marca = $hardwareInfo['system']['marca'];
            $recurso->modelo = $hardwareInfo['system']['model'];
            $recurso->serie = $hardwareInfo['system']['serial'];
            $details = [
                'micro' => $hardwareInfo['cpu']['brand'],
                'ram' => $hardwareInfo['memory']['total'],
                'disco' => $hardwareInfo['disk'],
            ];
            $recurso->details = json_encode($details);
            $recurso->comentario = 'Registrado automáticamente';

            $recurso->save();

            return response()->json(['status' => 'success', 'message' => 'Hardware registrado exitosamente']);
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
    }

    private function getHardwareInfo()
    {
        try {
            $process = new Process(['node', base_path('resources/js/hardware_info.js')]);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            $hardwareInfo = json_decode($process->getOutput(), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Error decoding JSON: ' . json_last_error_msg());
            }

            return $hardwareInfo;
        } catch (\Exception $e) {
            Log::error('Error collecting hardware info: ' . $e->getMessage());
            throw $e;
        }
    }
    public function edit(Recurso $recurso)
    {
        $tiposderecursos = TypeResource::all();
        $recursos = Recurso::all();
        // Verificar si details es una cadena antes de decodificar
        if (is_string($recurso->details)) {
            $recurso->details = json_decode($recurso->details, true); // Decodificar los detalles
        }
        return view('portal_it.layouts.edit_resource', compact('recurso', 'tiposderecursos', 'recursos'));
    }

    public function update(Request $request, Recurso $recurso)
    {
        
        $recurso = Recurso::find($recurso->id);
        $recurso->tipo_recurso = $request->input('tipo_recurso');
        $recurso->tag = $request->input('tag');
        $recurso->fecha_alta = $request->input('fecha_alta');
        $recurso->marca = $request->input('marca');
        $recurso->modelo = $request->input('modelo');
        $recurso->serie = $request->input('serie');
        // Otros campos de recurso
        
        // Codificar detalles a JSON
        $details = $request->input('details');
        $recurso->details = json_encode($details);

        $recurso->update();

        return redirect()->route('recurso.index')->with('status', 'Recurso actualizado exitosamente');
    }



}

