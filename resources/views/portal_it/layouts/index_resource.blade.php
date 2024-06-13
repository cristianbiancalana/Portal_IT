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
        @if (session('error'))
            <div class="alert alert-danger">
                <strong>
                    <svg style="width: 22px; height: 20px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008v.008H12v-.008Zm9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                    </svg>
                </strong>
                Error: {{ session('error') }}<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
<div class="col-12 mt-2">
    <div style="max-width: 1500px; margin: 0 auto 20px auto;">
        <table class="table table-sm table-dark table-hover" style="text-align:center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            <thead>
                <tr>
                    <th>ID Recurso |
                        <a href="{{ route('recurso.index', ['search' => request('search'), 'order' => 'id_asc']) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                                <path d="m12 6.879-7.061 7.06 2.122 2.122L12 11.121l4.939 4.94 2.122-2.122z"></path>
                            </svg>
                        </a>
                        <a href="{{ route('recurso.index', ['search' => request('search'), 'order' => 'id_desc']) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                                <path d="M16.939 7.939 12 12.879l-4.939-4.94-2.122 2.122L12 17.121l7.061-7.06z"></path>
                            </svg>
                        </a>
                    </th>
                    <th>Tipo de Recurso</th>
                    <th>Nombre del Recurso</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Serie</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recursos as $recurso)
                <tr style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                    <th scope="row">{{$recurso->id}}</th>
                    <td>{{ $recurso->tipo_recurso }}</td>
                    <td>{{$recurso->tag}}</td>
                    <td>{{$recurso->marca}}</td>
                    <td>{{$recurso->modelo}}</td>
                    <td>{{$recurso->serie}}</td>
                    <td style="width:100px; height: 20px;">
                        <a href="{{ route('recurso.edit',$recurso) }}" style="color:azure;">
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
        {{$recursos->links()}}
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <button class="btn btn-primary" onclick="registerHardware()" id="registerButton" name="registerButton" style="display: none;">Registrar
        <svg style="width: 30px; height: 28px; display:flex; flex-direction: column; text-align:center; margin:auto;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25"></path>
        </svg>
    </button>
   
</div>


<script>
    // Esta función se llama automáticamente para buscar el número de serie
    function startSerialCheck() {
        setInterval(function() {
            fetch('{{ route('checkSerial') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
                // No necesitas enviar ningún dato en el body para este caso
            }) 
            .then(response => response.json())
            .then(data => {
                console.log(data); // Manejar la respuesta del servidor aquí

                // Obtener el botón por su ID (o cualquier selector que uses)
                const btn = document.getElementById('registerButton'); // Reemplaza 'tu-boton-id' con el ID de tu botón

                // Verificar si el número de serie existe
                if (data.exists) {
                    // Si existe, mostrar el botón
                    btn.style.display = 'block';
                } else {
                    // Si no existe, ocultar el botón
                    btn.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }, 5000); // Ejecutar cada 5 segundos (5000 milisegundos)
    }

    function registerHardware() {
        fetch('/register-hardware', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => {
                    try {
                        // Intentar convertir el texto en JSON
                        const json = JSON.parse(text);
                        return Promise.reject(new Error(json.message || 'Unknown error'));
                    } catch (e) {
                        // Si la respuesta no es JSON, lanzar un error con el texto original
                        return Promise.reject(new Error('Network response was not ok: ' + response.statusText + ' - ' + text));
                    }
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'success') {
                showMessage('success', 'Hardware registrado exitosamente');
            } else {
                showMessage('error', 'Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('error', 'Ocurrió un error: ' + error.message);
            console.log("aca llego");
        });
    }

    function showMessage(type, message) {
        const messageContainer = document.getElementById('messageContainer');
        if (messageContainer) {
            messageContainer.innerHTML = `
                <div class="alert alert-${type === 'success' ? 'success' : 'danger'}">
                    <strong>${type === 'success' ? 'Éxito' : 'Error'}:</strong> ${message}
                </div>
            `;
        } else {
            console.error('messageContainer element not found');
        }
    }
</script>

@endsection