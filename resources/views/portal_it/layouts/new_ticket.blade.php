
@extends('portal_it.layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2>Nuevo Ticket</h2>
        </div>
        
    </div>

    <form  method="POST" action="{{route('nuevo_ticket')}}" enctype="multipart/form-data">
       
        @csrf 
        
        <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Solicitante</strong>
                    <label type="text" class="form-control">{{ Auth::user()->name }}</label>
                    <input type="hidden" name="user_id" class="form-control" id="estado" value="{{ Auth::user()->id }}">
                </div>
        </div>
        
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Estado</strong>
                    <input type="text" name="estado" class="form-control" id="estado" value="Registrado">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Fecha</strong>
                    <input type="date" name="fecha_origen" class="form-control" id="fecha_origen" value="{{ date('Y-m-d') }}">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Prioridad</strong>
                    <select name="prioridad" class="form-select" id="prioridad">
                        @foreach($prioridades as $prioridad)
                            <option value="{{ $prioridad->name_prioridades}}">{{ $prioridad->name_prioridades}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Gerencia</strong>
                    <input type="text" name="gerencia" class="form-control" id="gerencia" value="{{$user = auth()->user()->gerencia;}}">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Tipo de problema</strong>
                    <select name="tipoproblema" class="form-select" id="tipoproblema">
                        @foreach ($problemas as $problema)
                            <option value="{{ $problema->name_problema  }}">{{ $problema->name_problema }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Segmento</strong>
                    <select name="segmento" class="form-select" id="segmento">
                        @foreach ($segmentos as $segmento)
                            <option value="{{ $segmento->name_segmento}}">{{ $segmento->name_segmento }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Sistema</strong>
                    <select name="sistema" class="form-select" id="sistema">
                        @foreach ($sistemas as $sistema)
                            <option value="{{ $sistema->name_sistema}}">{{ $sistema->name_sistema }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Proveedor</strong>
                    <select name="proveedor" class="form-select" id="proveedor">
                        @foreach ($proveedores as $proveedor)
                            <option value="{{  $proveedor->name_proveedor }}">{{ $proveedor->name_proveedor}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2" style="margin-left:570px;">
                <div class="form-group">
                    <strong>Archivo Adjunto</strong>
                    <input type="file" name="ruta_adjunto" id="ruta_adjunto"  class="form-control" value="">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Asunto</strong>
                    <input type="text" name="asunto_ticket" class="form-control" placeholder="Asunto" >
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Comentario</strong>
                    <textarea class="form-control" style="height:150px" name="comentario_ticket" id="comentario_ticket" placeholder="Comentario..."></textarea>
                </div>
            </div>
            
            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                <button type="submit" class="btn btn-primary" style="width:100px;">Crear</button>
                <a href="{{route('totaltickets')}}" class="btn btn-primary"style="width:100px;">Volver</a>
            </div>
        </div>
    </form>
</div>
@endsection