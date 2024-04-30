@extends('portal_it.layouts.base')

@section('content')
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
    <div class="text-center" style="margin-top: 50px;">
        <div style="display: grid; grid-template-columns:1fr 1fr 1fr 1fr 1fr; justify-self:center; grid-gap: 45px;">
            <div class="text-center mt-2" style="margin-right: 10px;">
                <form id="form-gerencias" action="{{ route('mostrarTablaGerencias') }}" method="post">
                    @csrf
                    <button id="eleccion" name="eleccion"  value="gerencias" type="submit" class="btn btn-primary" style="width: 110px; margin-right: 10px;">Gerencia</button>
                </form>
            </div>
            <div class="text-center mt-2" style="margin-right: 10px;">
                <form id="form-gerencias" action="{{ route('mostrarTablaPuestos') }}" method="post">
                    @csrf
                    <button id="eleccion" name="eleccion" type="submit" class="btn btn-primary" style="width: 110px; margin-right: 10px;">Puestos</button>
                </form>
            </div>
            <div class="text-center mt-2" style="margin-right: 10px;">
                <form id="form-gerencias" action="{{ route('mostrarTablaSegmentos') }}" method="post">
                    @csrf
                    <button id="eleccion" name="eleccion" type="submit" class="btn btn-primary" style="width: 110px; margin-right: 10px;">Segmentos</button>
                </form>
            </div>
            <div class="text-center mt-2" style="margin-right: 10px;">
                <form id="form-gerencias" action="{{ route('mostrarTablaSistemas') }}" method="post">
                    @csrf
                    <button id="eleccion" name="eleccion" type="submit" class="btn btn-primary" style="width: 110px; margin-right: 10px;">Sistemas</button>
                </form>
            </div>
            <div class="text-center mt-2" style="margin-right: 10px;">
                <form id="form-gerencias" action="{{ route('mostrarTablaProblemas') }}" method="post">
                    @csrf
                    <button id="eleccion" name="eleccion" type="submit" class="btn btn-primary" style="width: 110px; margin-right: 10px;">Problemas</button>
                </form>
            </div>
            <div class="text-center mt-2" style="margin-right: 10px;">
                <form id="form-gerencias" action="{{ route('mostrarTablaEstados') }}" method="post">
                    @csrf
                    <button id="eleccion" name="eleccion" type="submit" class="btn btn-primary" style="width: 110px; margin-right: 10px;">Estados</button>
                </form>
            </div>
            <div class="text-center mt-2" style="margin-right: 10px;">
                <form id="form-gerencias" action="{{ route('mostrarTablaProveedores') }}" method="post">
                    @csrf
                    <button id="eleccion" name="eleccion" type="submit" class="btn btn-primary" style="width: 110px; margin-right: 10px;">Proveedores</button>
                </form>
            </div>
            <div class="text-center mt-2" style="margin-right: 10px;">
                <form id="form-gerencias" action="{{ route('mostrarTablaPrioridades') }}" method="post">
                    @csrf
                    <button id="eleccion" name="eleccion" type="submit" class="btn btn-primary" style="width: 110px; margin-right: 10px;">Prioridades</button>
                </form>
            </div>
            <div class="text-center mt-2" style="margin-right: 10px;">
                <form id="form-gerencias" action="{{ route('mostrarTablaTecnicos') }}" method="post">
                    @csrf
                    <button id="eleccion" name="eleccion" type="submit" class="btn btn-primary" style="width: 110px; margin-right: 10px;">Técnicos</button>
                </form>
            </div>
            <div class="text-center mt-2" style="margin-right: 10px;">
                <form id="form-roles" action="{{ route('mostrarTablaRoles') }}" method="post">
                    @csrf
                    <button id="eleccion" name="eleccion" type="submit" class="btn btn-primary" style="width: 110px; margin-right: 10px;">Roles</button>
                </form>
            </div>
        </div>
    </div>
    <div id="tabla-container" style="margin-top: 20px;"></div>
@endsection
