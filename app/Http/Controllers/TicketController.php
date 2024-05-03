<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Segmento;
use App\Models\Problema;
use App\Models\Proveedor;
use App\Models\Puesto;
use App\Models\Sistema;
use App\Models\Prioridad;
use App\Models\Estado;
use App\Models\Tecnico;
use App\Models\Gerencia;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Http\Controllers\SistemaController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProblemasController;
use App\Http\Controllers\ProveedorController;
use OpenAdmin\Admin\Grid\Filter\Where;

class TicketController extends Controller
{
    public function index()
    {
    }

    public function indexall()
    {
        if (!Auth::user()->hasPermissionTo('tickets.index') && !Auth::user()->hasPermissionTo('tickets.index.gerencia')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        if (Auth::user()->hasPermissionTo('tickets.index.gerencia')) {
            $tickets = Ticket::where('gerencia', Auth::user()->gerencia)->paginate(5);
        } else {
            $tickets = Ticket::paginate(5);
        }

        return view('portal_it.layouts.index_tickets', array('tickets' => $tickets));
    }

    public function indexpendientes()
    {
        if (!Auth::user()->hasPermissionTo('tickets.index.pendiente') && !Auth::user()->hasPermissionTo('tickets.index.gerencia.pendientes')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        if (Auth::user()->hasPermissionTo('tickets.index.gerencia.pendientes')) {
            echo 'acaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
            $tickets = Ticket::where('gerencia', Auth::user()->gerencia)
                ->where(function ($query) {
                    $query->where('estado', 'Registrado')
                        ->orWhere('estado', 'En Curso');
                })
                ->paginate(5);
                
        }else{
            echo 'acaaaaaaaaaaaaaaaaaaaaaaaaaaaaa2';
            $tickets = Ticket::where('estado', 'Registrado')
            ->orWhere('estado', 'En Curso')
            ->paginate(5);
        }
        
        return view('portal_it.layouts.index_tickets_pendientes', array('tickets' => $tickets));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('tickets.create')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $proveedores = Proveedor::all();
        $sistemas = Sistema::all();
        $segmentos = Segmento::all();
        $problemas = Problema::all();
        $prioridades = Prioridad::all();
        $tecnicos = Tecnico::all();
        return view('portal_it.layouts.new_ticket')->with([
            'problemas' => $problemas,
            'segmentos' => $segmentos,
            'sistemas' => $sistemas,
            'proveedores' => $proveedores,
            'prioridades' => $prioridades
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('tickets.store')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }


        if ($request->hasFile('ruta_adjunto')) {
            $archivo = $request->file('ruta_adjunto');
            $nombrearchivo = Str::random(20) . '.' . $archivo->getClientOriginalExtension();
            $rutaarchivo = $archivo->storeAs('public/archivos', $nombrearchivo);
            $ruta_adjunto = 'archivos/' . $nombrearchivo;
        } else {
            $ruta_adjunto = null;
        }

        $request->validate([
            'prioridad' => ['required', 'min:3'],
            'proveedor' => ['required', 'min:3'],
            'segmento' => ['required', 'min:3'],
            'sistema' => ['required', 'min:3'],
            'user_id' => ['required', 'min:1'],
            'tipoproblema' => ['required', 'min:3'],
            'gerencia' => ['required', 'min:3'],
            'fecha_origen' => ['required', 'min:3'],
            'estado' => ['required', 'min:3'],
            'asunto_ticket' => ['required', 'min:10'],
            'comentario_ticket' => ['required', 'min:10'],
            'resolucion_ticket' => ['nullable'],
            'fecha_resolucion' => ['nullable'],
            'archivo_adjunto' => ['nullable'],
            'ruta_adjunto' => ['nullable', 'file'],
            'adjunto_final' => ['nullable'],
            'ruta_resolucion' => ['nullable'],
            'tecnico'=> ['nullable']
        ]);
        $attributes = $request->all();

        if ($ruta_adjunto !== null) {
            $attributes['ruta_adjunto'] = 'archivos/' . $nombrearchivo;
        }
        $ticket = $request->user()->tickets()->create($attributes);

        session()->flash('status', 'Ticket Cargado correctamente');
        return redirect()->route('totaltickets');
    }
    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        if (!Auth::user()->hasPermissionTo('tickets.show')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        return view('portal_it.layouts.visualizar', ['ticket' => $ticket]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        if (!Auth::user()->hasPermissionTo('tickets.edit')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        $proveedores = Proveedor::all();
        $sistemas = Sistema::all();
        $segmentos = Segmento::all();
        $problemas = Problema::all();
        $prioridades = Prioridad::all();
        $estados = Estado::all();
        $gerencias = Gerencia::all();
        $tecnicos = Tecnico::all();
        return view('portal_it.layouts.edit', ['ticket' => $ticket])->with([
            'problemas' => $problemas,
            'segmentos' => $segmentos,
            'sistemas' => $sistemas,
            'proveedores' => $proveedores,
            'prioridades' => $prioridades,
            'estados' => $estados,
            'gerencias' => $gerencias,
            'tecnicos' => $tecnicos
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        if (!Auth::user()->hasPermissionTo('tickets.update')) {
            return redirect()->route('homeportal')->with('error', 'No tienes permisos para acceder a este sitio');
        }
        if ($request->hasFile('ruta_resolucion')) {
            $archivo1 = $request->file('ruta_resolucion');
            $nombrearchivo1 = Str::random(20) . '.' . $archivo1->getClientOriginalExtension();
            $rutaarchivo1 = $archivo1->storeAs('public/archivos', $nombrearchivo1);
            $ruta_resolucion = 'archivos/' . $nombrearchivo1;
        } else {
            $ruta_resolucion = null;
        }


        $validated = $request->validate([
            'prioridad' => ['required', 'min:3'],
            'proveedor' => ['required', 'min:3'],
            'segmento' => ['required', 'min:3'],
            'sistema' => ['required', 'min:3'],
            'tipoproblema' => ['required', 'min:3'],
            'gerencia' => ['required', 'min:3'],
            'fecha_origen' => ['required', 'min:3'],
            'estado' => ['required', 'min:3'],
            'asunto_ticket' => ['required', 'min:10'],
            'comentario_ticket' => ['required', 'min:10'],
            'resolucion_ticket' => ['nullable', 'string', 'min:10'],
            'fecha_resolucion' => ['nullable'],
            'archivo_adjunto' => ['nullable', 'file'],
            'ruta_adjunto' => ['nullable'],
            'adjunto_final' => ['nullable'],
            'ruta_resolucion' => ['nullable', 'file'],
            'tecnico' => ['nullable']

        ]);


        $ticket->update($validated);
        $ticket->update(['ruta_resolucion' => $ruta_resolucion]);

        return redirect()->route('totaltickets')->with('status', 'Ticket actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
