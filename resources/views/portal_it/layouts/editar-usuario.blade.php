
@extends('portal_it.layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2><svg style="width: 38px; height: 36px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 2 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                </svg>
                {{$user->name}}
            </h2>
        </div>
        
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
            <strong><svg style="width: 22px; height: 20px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"></path>
                </svg>
            </strong>Error al editar usuario, verificar: <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form  method="POST" action="{{route('user.update',$user)}}">
        @method('PUT')
        @csrf 
        
        <div class="row">
        
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Nombre</strong>
                    <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}">
                </div> 
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4 mt-2">
                <div class="form-group">
                    <strong>Email</strong>
                    <input type="text" name="email" class="form-control" id="email" value="{{$user->email}}">
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Gerencia</strong>
                    <select name="gerencia" class="form-select" id="gerencia" >
                        @foreach($gerencias as $gerencia)
                            <option value="{{$gerencia->nombre_gerencia}}" {{$gerencia->nombre_gerencia === $user->gerencia? 'selected' : ''}}>{{$gerencia->nombre_gerencia}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Puesto</strong>
                    <select name="puesto" class="form-select" id="puesto">
                        @foreach($puestos as $puesto)
                            <option value="{{$puesto->name_puesto}}" {{$puesto->name_puesto === $user->puesto? 'selected' : ''}}>{{$puesto->name_puesto}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 mt-2">
                <div class="form-group">
                    <strong>Rol actual</strong>
                    <select name="role_id" id="role_id" class="form-control" required>
                        <option value="" selected disabled>Seleccionar Rol</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                        @if (!$user->role_id)
                            <small class="form-text text-muted">No tiene un rol asignado.</small>
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2" >
                <button type="submit" class="btn btn-primary" style="width:100px;">Actualizar</button>
                <a href="{{route('usuarios')}}" class="btn btn-primary" style="width:100px;">Volver</a>
            </div>
    </form>
</div>
@endsection