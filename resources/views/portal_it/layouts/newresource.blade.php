@extends('portal_it.layouts.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div>
                <h2 class="text-white">Nuevo Recurso</h2>
            </div>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
                <strong><svg style="width: 22px; height: 20px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1-18 0Zm-9 3.75h.008v.008H12v-.008Z"></path>
                    </svg>
                </strong>Error al editar el prioridades<br><br>
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
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1-18 0Zm-9 3.75h.008v.008H12v-.008Z"></path>
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1-18 0Zm-9 3.75h.008v.008H12v-.008Z"></path>
                        </svg>
                </strong>Prioridad Eliminada<br><br>
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
    </div>
</div>
<form method="POST" action="{{route('nuevo_ticket')}}" enctype="multipart/form-data" id="form">  
    @csrf    
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 mt-2">
            <div class="form-group">
                <strong>Tipo de Recurso</strong>
                <select name="name_tiposderecursos" id="name_tiposderecursos" class="form-select" id="prioridad">
                    <option>Seleccione una Opción</option>
                    @foreach($tiposderecursos as $tiposderecurso)
                        <option value="{{ $tiposderecurso->name_tiposderecursos}}">{{ $tiposderecurso->name_tiposderecursos}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4 mt-2">
            <div class="form-group">
                <strong>Fecha de Alta</strong>
                <input type="date" name="fecha_alta" class="form-control" id="fecha_alta" value="{{ date('Y-m-d') }}">
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="form-group">
                <div id="dynamic-content" style="display:grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;"></div>
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="form-group">
                <strong>Comentario</strong>
                <textarea class="form-control" style="height:150px" name="comentario_ticket" id="comentario_ticket" placeholder="Comentario..."></textarea>
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
        const selectElement = document.getElementById('name_tiposderecursos');
        const dynamicContent = document.getElementById('dynamic-content');
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'details';
        hiddenInput.id = 'details';
        document.forms[0].appendChild(hiddenInput);

        selectElement.addEventListener('change', function () {
            const selectedValue = selectElement.value;
            dynamicContent.innerHTML = '';

            if (selectedValue === 'Notebook') {
                dynamicContent.innerHTML = `
                    <div class="form-group">
                        <strong>Marca</strong>
                        <input type="text" name="marca" class="form-control">
                    </div>
                    <div class="form-group">
                        <strong>Modelo</strong>
                        <input type="text" name="modelo" class="form-control">
                    </div>
                    <div class="form-group">
                        <strong>Serie</strong>
                        <input type="text" name="serie" class="form-control">
                    </div>
                    <div class="form-group">
                        <strong>Microprocesador</strong>
                        <input type="text" name="micro" class="form-control">
                    </div>
                    <div class="form-group">
                        <strong>Memoria RAM</strong>
                        <input type="text" name="ram" class="form-control">
                    </div>
                    <div class="form-group">
                        <strong>Disco</strong>
                        <input type="text" name="disco" class="form-control">
                    </div>
                `;
            } else if (selectedValue === 'Impresora') {
                dynamicContent.innerHTML = `
                    <div class="form-group">
                        <strong>Marca</strong>
                        <input type="text" name="marca" class="form-control">
                    </div>
                    <div class="form-group">
                        <strong>Modelo</strong>
                        <input type="text" name="modelo" class="form-control">
                    </div>
                    <div class="form-group">
                        <strong>Serie</strong>
                        <input type="text" name="serie" class="form-control">
                    </div>
                `;
            } else if (selectedValue === 'Celular') {
                dynamicContent.innerHTML = `
                    <div class="form-group">
                        <strong>Marca</strong>
                        <input type="text" name="marca" class="form-control">
                    </div>
                    <div class="form-group">
                        <strong>Modelo</strong>
                        <input type="text" name="modelo" class="form-control">
                    </div>
                    <div class="form-group">
                        <strong>Serie</strong>
                        <input type="text" name="serie" class="form-control">
                    </div>
                    <div class="form-group">
                        <strong>IMEI</strong>
                        <input type="text" name="imei" class="form-control">
                    </div>
                `;
            } // Continúa con las demás opciones...

            // Actualizar el campo oculto con los valores actuales
            updateHiddenInput();
        });

        dynamicContent.addEventListener('input', function () {
            updateHiddenInput();
        });

        function updateHiddenInput() {
            const inputs = dynamicContent.querySelectorAll('input');
            const details = {};
            inputs.forEach(input => {
                details[input.name] = input.value;
            });
            hiddenInput.value = JSON.stringify(details);
        }
    });
</script>

@endsection
