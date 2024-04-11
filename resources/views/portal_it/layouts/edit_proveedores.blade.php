@extends('portal_it.layouts.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div>
                <h2 class="text-white">Proveedor</h2>
            </div>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
                <strong><svg style="width: 22px; height: 20px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"></path>
                    </svg>
                </strong>Error al editar el proveedor, verificar: <br><br>
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
        @if (session('status'))
            <div class="alert alert-success">
            <svg style="width: 22px; height: 20px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z"></path>
            </svg>{{ session('status') }}
            </div>
        @endif

        <div class="col-6 mt-4">
                <h3 class="text-white">Actualizar Proveedor</h3>
                    <form action="{{route('proveedores.update',$proveedor)}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <strong>Nombre del Proveedor</strong>
                            <input type="text" name="name_proveedor" id="name_proveedor"  class="form-control" style="height:25px;" value="{{$proveedor->name_proveedor}}">
                        </div>
                        <div class="form-group">
                            <strong>Contacto del Proveedor</strong>
                            <input type="text" name="contacto1_proveedor" id="contacto1_proveedor"  class="form-control" style="height:25px;" value="{{$proveedor->contacto1_proveedor}}">
                        </div>
                        <div class="form-group">
                            <strong>Teléfono del Contacto</strong>
                            <input type="text" name="tel1_proveedor" id="tel1_proveedor"  class="form-control" style="height:25px;" value="{{$proveedor->tel1_proveedor}}">
                        </div>
                        <div class="form-group">
                            <strong>Segundo Contacto</strong>
                            <input type="text" name="contacto2_proveedor" id="contacto2_proveedor"  class="form-control" style="height:25px;" value="{{$proveedor->contacto2_proveedor}}">
                        </div>
                        <div class="form-group">
                            <strong>Teléfono del Segundo Contacto</strong>
                            <input type="text" name="tel2_proveedor" id="tel2_proveedor"  class="form-control" style="height:25px;" value="{{$proveedor->tel2_proveedor}}">
                        </div>
                        <div class="form-group">
                            <strong>Comentario</strong>
                            <input type="text" name="comentario" id="comentario"  class="form-control" style="height:25px;" value="{{$proveedor->comentario}}">
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-xs-4 col-sm-4 col-md-4 text-center mt-2">
                                <button type="submit" class="btn btn-primary" style="width:100px;">Actualizar</button>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 text-center mt-2">
                                <a href="{{route('vistaproveedores')}}" class="btn btn-primary" style="width:100px;">Volver</a>
                            </div>
                        </div>
                    </form>
        </div>
@endsection