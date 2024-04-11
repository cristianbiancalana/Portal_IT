
@extends('portal_it.layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2>Editar Ticket Nro: {{$ticket->id}}</h2>
        </div>
        
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
            <strong><svg style="width: 22px; height: 20px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"></path>
                </svg>
            </strong>Error al editar el ticket, verificar: <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form  method="POST" action="{{route('tickets.update',$ticket)}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf 
        
        <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Solicitante</strong>
                    <input type="text" name="solicitante" id="solicitante"  class="form-control" value="{{ Auth::user()->name }}">
                </div>
        </div>
        
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Estado</strong>
                    <select name="estado" class="form-select" id="estado">
                        <option value="Registrado" @selected('Registrado' === $ticket->estado)>Registrado</option>
                        <option value="En Curso" @selected('En Curso' === $ticket->estado)>En Curso</option>
                        <option value="Resuelto" @selected('Resuelto' === $ticket->estado)>Resuelto</option>
                    </select>
                </div> 
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Fecha</strong>
                    <input type="date" name="fecha_origen" class="form-control" id="fecha_origen" value="{{ $ticket->fecha_origen}}">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Prioridad</strong>
                    <select name="prioridad" class="form-select" id="prioridad">
                        <option value="Baja" @selected('Baja' === $ticket->prioridad)>Baja  </option>
                        <option value="Media"@selected('Media' === $ticket->prioridad)> Media </option>
                        <option value="Alta" @selected('Alta' === $ticket->prioridad)> Alta  </option>
                        <option value="Crítica" @selected('Crítica' === $ticket->prioridad)> Crítica</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Gerencia</strong>
                    <select name="gerencia" class="form-select" id="gerencia" >
                        <option value="Administración" @selected('Administración' === $ticket->gerencia)>Administración</option>
                        <option value="Almacenamiento" @selected('Almacenamiento' === $ticket->gerencia)>Almacenamiento</option>
                        <option value="Comercial" @selected('Comercial' === $ticket->gerencia)>Comercial</option>
                        <option value="Distribución" @selected('Distribución' === $ticket->gerencia)>Distribución</option>
                        <option value="Proyectos Estratégicos" @selected('Proyectos Estratégicos' === $ticket->gerencia)>Proyectos Estratégicos</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Tipo de problema</strong>
                    <select name="tipoproblema" class="form-select" id="tipoproblema">
                        <option value="Conectividad" @selected('Conectividad' === $ticket->tipoproblema)>Conectividad</option>
                        <option value="Equipamiento" @selected('Equipamiento' === $ticket->tipoproblema)>Equipamiento</option>
                        <option value="Información" @selected('Información' === $ticket->tipoproblema)>Información</option>
                        <option value="Infraestructura" @selected('Infraestructura' === $ticket->tipoproblema)>Infraestructura</option>
                        <option value="Insumos" @selected('Insumos' === $ticket->tipoproblema)>Insumos</option>
                        <option value="Mantenimiento" @selected('Mantenimiento' === $ticket->tipoproblema)>Mantenimiento</option>
                        <option value="Soporte" @selected('Soporte' === $ticket->tipoproblema)>Soporte</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Segmento</strong>
                    <select name="segmento" class="form-select" id="segmento">
                        <option value="Estabilización" @selected('Estabilización' === $ticket->segmento)>Estabilización</option>
                        <option value="Soporte" @selected('Soporte' === $ticket->segmento)>Soporte</option>
                        <option value="Mejoras" @selected('Mejoras' === $ticket->segmento)>Mejoras</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Sistema</strong>
                    <select name="sistema" class="form-select" id="sistema">
                        <option value="SAP B1" @selected('SAP B1' === $ticket->sistema)>SAP B1</option>
                        <option value="SAP B1" @selected('Produmex' === $ticket->sistema)>Produmex</option>
                        <option value="SAP B1" @selected('SalesForce' === $ticket->sistema)>SalesForce</option>
                        <option value="SAP B1" @selected('Otros' === $ticket->sistema)>Otros</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Proveedor</strong>
                    <select name="proveedor" class="form-select" id="proveedor">
                        <option value="IT Cedisur" @selected('IT Cedisur' === $ticket->proveedor)>IT Cedisur</option>
                        <option value="Pragmatica" @selected('Pragmatica' === $ticket->proveedor)>Pragmatica</option>
                        <option value="Cambalache" @selected('Cambalache' === $ticket->proveedor)>Cambalache</option>
                        <option value="Seidor" @selected('Seidor' === $ticket->proveedor)>Seidor</option>
                        <option value="Interconexión" @selected('Interconexión' === $ticket->proveedor)>Interconexión</option>
                        <option value="Teknos Group" @selected('Teknos Group' === $ticket->proveedor)>Teknos Group</option>
                        <option value="Vuritec" @selected('IT Vuritec' === $ticket->proveedor)>Vuritec</option>
                        <option value="Biancalana Omar" @selected('Biancalana Omar' === $ticket->proveedor)>Biancalana Omar</option>
                        <option value="Otros" @selected('Otros' === $ticket->proveedor)>Otros</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2" >
                <div class="form-group">
                <strong>Archivo Adjunto</strong>
                @if($ticket->ruta_adjunto)
                    <a href="{{asset($ticket->ruta_adjunto)}}" class="form-control" target="_blank">Visualizar Adjunto</a>
                @else
                    <input type="file" name="ruta_adjunto" id="ruta_adjunto"  class="form-control" value="">
                @endif
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Fecha Resolución</strong>
                    <input type="date" name="fecha_resolucion" class="form-control" id="fecha_resolucion" value="{{ $ticket->fecha_resolucion}}">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2" >
                <div class="form-group">
                    <strong>Archivo Adjunto Resolución</strong>
                        @if($ticket->ruta_resolucion)
                            <a href="{{ asset($ticket->ruta_resolucion) }}" class="form-control" target="_blank">Visualizar Adjunto de Resolución</a>
                        @else
                            <input type="file" name="ruta_resolucion" id="ruta_resolucion"  class="form-control" value="">
                        @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Asunto</strong>
                    <input type="text" name="asunto_ticket" name="asunto_ticket" class="form-control" placeholder="Asunto" value="{{ $ticket->asunto_ticket }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Comentario</strong>
                    <strong style="margin-left:480px;">Resolución</strong>
                    <textarea class="form-control" style="height:150px; width: 550px;" name="comentario_ticket" id="comentario_ticket" placeholder="Comentario...">{{ $ticket->comentario_ticket }}</textarea>
                </div>
                <div class="form-group">
                    
                    <textarea class="form-control" style="margin-left:560px; margin-top:-150px; height:150px; width: 550px;" name="resolucion_ticket" id="resolucion_ticket" placeholder="Resolución...">{{ $ticket->resolucion_ticket }}</textarea>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2" >
                <a href="{{route('totaltickets')}}" class="btn btn-primary" style="width:100px;">Volver</a>
            </div>
        </div>
    </form>
</div>
@endsection