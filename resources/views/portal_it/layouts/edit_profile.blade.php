@extends('portal_it.layouts.base')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-12">
            <h2 class="text-white">Editar Perfil</h2>
        </div>

        @if ($errors->any())
        <div class="col-12">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Error al editar el perfil, verificar:</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        @if (session('error'))
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error: {{ session('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif

        @if (session('success'))
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif

        <div class="col-xs-12 col-sm-12 col-md-4">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}">
                </div>

                <div class="mb-3">
                    <label for="gerencia" class="form-label">Gerencia</label>
                    <select name="gerencia" class="form-select" id="gerencia">
                        @foreach($gerencias as $gerencia)
                        <option value="{{ $gerencia->nombre_gerencia }}" {{ $gerencia->nombre_gerencia === $user->gerencia ? 'selected' : '' }}>
                            {{ $gerencia->nombre_gerencia }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="puesto" class="form-label">Puesto</label>
                    <select name="puesto" class="form-select" id="puesto">
                        @foreach($puestos as $puesto)
                        <option value="{{ $puesto->name_puesto }}" {{ $puesto->name_puesto === $user->puesto ? 'selected' : '' }}>
                            {{ $puesto->name_puesto }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
                </div>
            </form>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4">
            <form action="{{ route('profile.changePassword') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="current_password" class="form-label">Contraseña actual</label>
                    <input type="password" name="current_password" class="form-control" id="current_password">
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">Contraseña Nueva</label>
                    <input type="password" name="new_password" class="form-control" id="new_password">
                </div>

                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Confirmar Contraseña Nueva</label>
                    <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation">
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection