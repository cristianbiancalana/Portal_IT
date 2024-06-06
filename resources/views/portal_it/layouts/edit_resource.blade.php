@extends('portal_it.layouts.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="text-white">Editar Recurso</h2>
        </div>
    </div>
    <form action="{{ route('recurso.update', $recurso) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tipo_recurso">Tipo de Recurso</label>
            <select name="tipo_recurso" id="tipo_recurso" class="form-select">
                <option>Seleccione una Opción</option>
                    @foreach($tiposderecursos as $tiposderecurso)
                    <option value="{{$tiposderecurso->name_tiposderecursos}}" {{$tiposderecurso->name_tiposderecursos === $recurso->tipo_recurso ? 'selected' : ''}}>{{$tiposderecurso->name_tiposderecursos}}</option>                    
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tag">Tag</label>
            <input type="text" name="tag" value="{{ $recurso->tag }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fecha_alta">Fecha de Alta</label>
            <input type="date" name="fecha_alta" value="{{ $recurso->fecha_alta }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" name="marca" value="{{ $recurso->marca }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" name="modelo" value="{{ $recurso->modelo }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="serie">Serie</label>
            <input type="text" name="serie" value="{{ $recurso->serie }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="comentario">Comentario</label>
            <textarea name="comentario" class="form-control">{{ $recurso->comentario }}</textarea>
        </div>
        @if(isset($recurso->details))
            @foreach($recurso->details as $key => $value)
                <div class="form-group">
                    <label for="details[{{ $key }}]">{{ ucfirst($key) }}</label>
                    <input type="text" name="details[{{ $key }}]" value="{{ is_array($value) ? json_encode($value) : $value }}" class="form-control">
                </div>
            @endforeach
        @endif
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection