@extends('portal_it.layouts.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div>
                <h2 class="text-white">Panel de Usuarios</h2>
            </div>
        </div>
            @if ($errors->any())
        <div class="alert alert-danger">
                <strong><svg style="width: 22px; height: 20px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"></path>
                    </svg>
                </strong>Error al editar el usuario<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">
                <strong><svg style="width: 22px; height: 20px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"></path>
                    </svg>
                </strong>Error: {{ session('error') }}<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('warning'))
        <div class="alert alert-warning">
                <strong><svg style="width: 22px; height: 20px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"></path>
                        </svg>
                </strong>Usuario Eliminado<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success">
            <svg style="width: 22px; height: 20px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z"></path>
            </svg>{{ session('status') }}
            </div>
        @endif
        <div class="col-8 mt-2">
            <h3 class="text-white">Listado de Usuarios</h3>
            <div style="max-width: 1500px; margin: 0 auto; text-align:center;">
            <table class="table table-sm table-dark table-hover" style="text-align:center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <thead>
                        <tr>
                            <th>ID Usuario</th>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name }}</td>
                            <td>
                                @foreach ($user->getRoleNames() as $role)
                                    <span>{{ $role }}</span>
                                @endforeach
                            </td>
                            <td style="width:200px; height: 20px; ">
                                <a href="{{route('user.edit',$user)}}" style="color:azure;">
                                <svg style="width: 22px; height: 20px; margin-left:10px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"></path>
                                </svg>
                                </a>
                                <a href="#" style="color:azure;">
                                <svg style="width: 22px; height: 20px; margin-left:10px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z"></path>
                                </svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="display: flex; justify-content: center; margin-top:5px; ">
                    {{$users->links()}}
                </div>
            </div>
            <div class="text-center mt-2">
                <a href="{{route('parametros')}}" class="btn btn-primary" style="width:100px;">Volver</a>
            </div>
        </div>
        <div class="col-4 mt-1">
            <h3 class="text-white">Crear Usuario</h3>
            <div style="max-width: 1500px; margin: 0 auto;">
                <form action="{{route('store.usuarios')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <strong>Nombre y Apellido</strong>
                        <input type="text" name="name" id="name"  class="form-control" style="height:35px;">
                    </div>
                    <div class="form-group">
                        <strong>Email</strong>
                        <input id="email" name="email" type="email" class="form-control" required="" style="height:35px;">                
                    </div>
                    <div class="form-group">
                        <strong>Contraseña</strong>
                        <input type="password" name="password" id="password"  class="form-control" style="height:35px;">
                    </div>
                    <div class="form-group">
                        <strong>Confirmar Contraseña</strong>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required="" style="height:35px;">
                    </div>
                    <div class="form-group">
                        <strong>Gerencia</strong>
                        <select id="gerencia" name="gerencia" class="form-control" style="height:35px;">
                            @foreach ($gerencias as $gerencia)
                                <option value= "{{ $gerencia->nombre_gerencia }}">{{ $gerencia->nombre_gerencia }}</option>
                            @endforeach
                        </select>                
                    </div>
                    <div class="form-group">
                        <strong>Puesto</strong>
                        <select id="puesto" name="puesto" class="form-control" id="puesto" style="height:35px;">
                            @foreach ($puestos as $puesto)
                                <option value="{{ $puesto->name_puesto }}">{{ $puesto->name_puesto }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <strong>Rol</strong>
                        <select name="role_id" id="role_id" class="form-control" required style="height:35px;">
                            <option value="" selected disabled>Seleccionar Rol</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                        <button type="submit" class="btn btn-primary" style="width:100px;">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
