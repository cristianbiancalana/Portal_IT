@extends('portal_it.layouts.base')

@section('content')
    <h1>Asignar Rol</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('asignar-rol.submit') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">ID de Usuario:</label>
            <input type="text" id="user_id" name="user_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="role_id">Rol:</label>
            <select name="role_id" id="role_id" class="form-control" required>
                <option value="">Seleccionar Rol</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Asignar Rol</button>
    </form>
@endsection
