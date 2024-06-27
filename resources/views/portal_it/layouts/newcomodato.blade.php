@extends('portal_it.layouts.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div>
                <h2 class="text-white">Recursos</h2>
            </div>
        </div>
        <div id="messageContainer"></div>
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
        <div class="col-xs-12 col-sm-6 col-md-4 mt-2">
            <div class="form-group">
                <div class="form-group">
                    <strong for="searchResource">Recurso</strong>
                    <input type="text" id="searchResource" name="searchResource" class="form-control" placeholder="Ingrese ID o nombre del recurso">
                </div>
                <button style="margin-left:300px; margin-top:-66px;" type="submit" class="btn btn-primary" id="btnBuscar">
                    <svg style="width: 22px; height: 20px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('btnBuscar').addEventListener('click', function(event) {
            event.preventDefault();
            const searchValue = document.getElementById('searchResource').value;

            fetch(`/search-resource?query=${searchValue}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('marca').value = data.resource.marca;
                        document.getElementById('modelo').value = data.resource.modelo;
                        document.getElementById('serie').value = data.resource.serie;
                        document.getElementById('tipo_recurso').value = data.resource.tipo_recurso;

                        if (data.resource.tipo_recurso === 'Celular') {
                            document.getElementById('imei-group').style.display = 'block';
                            if (data.resource.details && data.resource.details.imei) {
                                document.getElementById('imei').value = data.resource.details.imei;
                            } else {
                                document.getElementById('imei').value = '';
                            }
                        } else {
                            document.getElementById('imei-group').style.display = 'none';
                        }
                    } else {
                        alert('Recurso no encontrado');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>

    <form id="comodatoForm" method="POST" action="{{route('comodato.store')}}" enctype="multipart/form-data">  
        @csrf    
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4 mt-2">
                <div class="form-group">
                    <strong>Nombre del usuario</strong>
                    <select name="user" id="user" class="form-select">
                        <option>Seleccione usuario asignado</option>
                        @foreach($users as $user)
                                <option value="{{ $user->name}}">{{ $user->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 mt-2">
                <div class="form-group">
                    <strong>Puesto a cubrir</strong>
                    <select name="puesto" id="puesto" class="form-select">
                        <option>Seleccione usuario asignado</option>
                        @foreach($puestos as $puesto)
                                <option value="{{ $puesto->name_puesto}}">{{ $puesto->name_puesto}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 mt-2">
                <div class="form-group">
                    <strong>Tipo de Recurso</strong>
                    <input type="text" name="tipo_recurso" id="tipo_recurso" class="form-control" value="">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 mt-2">
                <div class="form-group">
                    <strong>Fecha de Alta</strong>
                    <input type="date" name="fecha_alta" class="form-control" id="fecha_alta" value="{{ date('Y-m-d') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 mt-2">
                <div class="form-group">
                    <strong>Marca</strong>
                    <input type="text" name="marca" class="form-control" id="marca" value="">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 mt-2">
                <div class="form-group">
                    <strong>Modelo</strong>
                    <input type="text" name="modelo" class="form-control" id="modelo" value="">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 mt-2">
                <div class="form-group">
                    <strong>Número de Serie</strong>
                    <input type="text" name="serie" class="form-control" id="serie" value="">
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 mt-2" id="imei-group" style="display:none;">
                <div class="form-group">
                    <strong>IMEI</strong>
                    <input type="text" name="imei" class="form-control" id="imei" value="">
                </div>
            </div>
            <input type="hidden" name="details" id="details">
            <div class="col-12 mt-2">
                <div class="form-group">
                    <strong>Observación</strong>
                    <textarea class="form-control" style="height:150px" name="comentario" id="comentario" placeholder="Comentario..."></textarea>
                </div>
            </div>
            <div class="col-12 text-center mt-2">
                <button type="submit" class="btn btn-primary" style="width:100px;">Crear</button>
                <a href="" class="btn btn-primary" style="width:100px;">Volver</a>
            </div>
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('comodatoForm');
            
            if (form) {
                const selectElement = document.getElementById('tipo_recurso');
                const imeiGroup = document.getElementById('imei-group');
                const imeiInput = document.getElementById('imei');
                const detailsInput = document.getElementById('details');

                selectElement.addEventListener('input', function () {
                    if (selectElement.value === 'Celular') {
                        imeiGroup.style.display = 'block';
                    } else {
                        imeiGroup.style.display = 'none';
                    }
                });

                form.addEventListener('submit', function () {
                    const details = {
                        imei: imeiInput.value
                    };
                    detailsInput.value = JSON.stringify(details);
                });
            } else {
                console.error('Formulario no encontrado: verifica que el ID "comodatoForm" esté presente en el formulario.');
            }
        });
    </script>
@endsection
