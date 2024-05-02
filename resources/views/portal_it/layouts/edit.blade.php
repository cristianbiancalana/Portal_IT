
@extends('portal_it.layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2>Editar Ticket Nro: {{$ticket->id}}</h2>
            <div> Tecnico Asignado </div>
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
                    @foreach($estados as $estado)
                        <option value="{{$estado->name_estados}}" {{$estado->name_estados === $ticket->estado ? 'selected' : ''}}>{{$estado->name_estados}}</option>
                    @endforeach
                    </select>
                </div> 
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Fecha</strong>
                    <input type="date" name="fecha_origen" class="form-control" id="fecha_origen" value="{{$ticket->fecha_origen}}">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Prioridad</strong>
                    <select name="prioridad" class="form-select" id="prioridad">
                    @foreach($prioridades as $prioridad)
                        <option value="{{$prioridad->name_prioridades}}" {{$prioridad->name_prioridades === $ticket->prioridad ? 'selected' : ''}}>{{$prioridad->name_prioridades}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Gerencia</strong>
                    <select name="gerencia" class="form-select" id="gerencia" >
                        @foreach($gerencias as $gerencia)
                            <option value="{{$gerencia->nombre_gerencia}}" {{$gerencia->nombre_gerencia === $ticket->gerencia? 'selected' : ''}}>{{$gerencia->nombre_gerencia}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Tipo de problema</strong>
                    <select name="tipoproblema" class="form-select" id="tipoproblema">
                        @foreach($problemas as $problema)
                            <option value="{{$problema->name_problema}}" {{$problema->name_problema === $ticket->problema? 'selected' : ''}}>{{$problema->name_problema}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Segmento</strong>
                    <select name="segmento" class="form-select" id="segmento">
                        @foreach($segmentos as $segmento)
                            <option value="{{$segmento->name_segmento}}" {{$segmento->name_segmento === $ticket->segmento? 'selected' : ''}}>{{$segmento->name_segmento}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Sistema</strong>
                    <select name="sistema" class="form-select" id="sistema">
                        @foreach($sistemas as $sistema)
                            <option value="{{$sistema->name_sistema}}" {{$sistema->name_sistema === $ticket->sistema? 'selected' : ''}}>{{$sistema->name_sistema}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Proveedor</strong>
                    <select name="proveedor" class="form-select" id="proveedor">
                        @foreach($proveedores as $proveedor)
                            <option value="{{$proveedor->name_proveedor}}" {{$proveedor->name_proveedor === $ticket->proveedor? 'selected' : ''}}>{{$proveedor->name_proveedor}}</option>
                        @endforeach
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
                <button type="submit" class="btn btn-primary" style="width:100px;">Actualizar</button>
                <a href="{{route('totaltickets')}}" class="btn btn-primary" style="width:100px;">Volver</a>
            </div>
        </div>
    </form>
</div>
@endsection