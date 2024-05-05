
@extends('portal_it.layouts.base')

@section('content')
<style>
    /* Estilos para el tooltip */
    .info_tecnicos_visto {
        position: absolute;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        z-index: 9999;
        color: black;
    }

    /* Estilos para el icono */
    #icono-tecnico {
        cursor: pointer;
    }
</style>
<div class="row">
    <div class="col-12">
        <div style="display: flex;">
            <h3>Editar Ticket Nro: {{$ticket->id}}</h3>
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
    <div id="tooltip-tecnico" class="info_tecnicos_visto" style=" height:90px; width: 320px; margin-top:-35px; margin-left:320px; display: none;">
        @foreach ($tecnicos as $tecnico)
            @if ($tecnico->name_tecnicos === $ticket->tecnico)
                <strong>Nombre: </strong> <label for="">{{$tecnico->name_tecnicos}}</label><br>
                <strong>Email: </strong> <label for="">{{$tecnico->email_tecnicos}}</label><br>
                <strong>Celular: </strong> <label for="">{{$tecnico->tel_tecnicos}}</label><br>
            @endif
        @endforeach
    </div>
    <form  method="POST" action="{{route('tickets.update',$ticket)}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf 
        
        <div class="col-2" style=" height:40px; width: 500px; margin-top:-10px; display:flex;">
            <div style="height:40px; width: 400px; margin-left: 300px; margin-top:-30px; display:flex;" id="icono-tecnico"> 
                    <strong style="width:400px; text-align:center;height:50px;padding:5px;"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M6 22h13a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h1zm6-17.001c1.647 0 3 1.351 3 3C15 9.647 13.647 11 12 11S9 9.647 9 7.999c0-1.649 1.353-3 3-3zM6 17.25c0-2.219 2.705-4.5 6-4.5s6 2.281 6 4.5V18H6v-.75z">
                    </path></svg>
                    Técnico Asignado</strong>
                    <select name="tecnico" class="form-select" id="tecnico" style="margin-left: 5px">
                        @foreach ($tecnicos as $tecnico)
                            <option value="{{$tecnico->name_tecnicos}}" {{$tecnico->name_tecnicos === $ticket->tecnico ? 'selected' : ''}}>{{$tecnico->name_tecnicos}}</option>
                        @endforeach
                    </select>
            </div>
            
        </div>
        
        <div class="row" style="margin-top:-35px;">
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
                    <strong style="margin-left:470px;">Resolución</strong>
                    <textarea class="form-control" style="height:140px; width: 550px;" name="comentario_ticket" id="comentario_ticket" placeholder="Comentario...">{{ $ticket->comentario_ticket }}</textarea>
                </div>
                <div class="form-group">
                    
                    <textarea class="form-control" style="margin-left:560px; margin-top:-140px; height:140px; width: 550px;" name="resolucion_ticket" id="resolucion_ticket" placeholder="Resolución...">{{ $ticket->resolucion_ticket }}</textarea>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2" >
                <button type="submit" class="btn btn-primary" style="width:100px;">Actualizar</button>
                <a href="{{route('totaltickets')}}" class="btn btn-primary" style="width:100px;">Volver</a>
            </div>
        </div>
    </form>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const iconoTecnico = document.getElementById('icono-tecnico');
        const tooltipTecnico = document.getElementById('tooltip-tecnico');

        // Función para mostrar el tooltip del técnico
        function mostrarTooltipTecnico(event) {
            tooltipTecnico.style.display = 'block';
        }

        // Función para ocultar el tooltip del técnico
        function ocultarTooltipTecnico(event) {
            tooltipTecnico.style.display = 'none';
        }

        // Asignar eventos de mouse al icono
        iconoTecnico.addEventListener('mouseover', mostrarTooltipTecnico);
        iconoTecnico.addEventListener('mouseout', ocultarTooltipTecnico);
    });
</script>
@endsection