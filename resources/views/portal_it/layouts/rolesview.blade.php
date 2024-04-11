
@extends('portal_it.layouts.base')

@section('content')
    <style> 
        .detalles {
            display: none; /* Ocultar detalles por defecto */
            }
    </style>

    <div class="row">
        <div class="col-12">
            <div>
                <h2>Roles</h2>
            </div>
            
        </div>

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
        <div class="col-6 mt-2">
            <h3 class="text-white">Listado de Roles</h3>
            <div style="max-width: 1500px; margin: 0 auto; text-align:center;">
                <table class="table table-sm table-dark table-hover">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Nombre del Rol</th>
                        <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <th scope="row">{{$role->id }}</th>
                        <td>{{ $role->name}}</td>
                        <td style="width:150px; height: 20px; ">
                            <a href="#" style="color:azure;">
                                <svg style="width: 22px; height: 20px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"></path>
                                </svg>
                            </a>
                            <form action="#" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background-color: transparent; border: none; padding: 0; color:azure;">
                                    <svg style="width: 22px; height: 20px;" data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path>
                                    </svg>
                                </button>
                            </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <h3 class="text-white">Crear Rol</h3>
        <div style="display:flex; margin-left:15px;">
            <form action="{{route('store.roles')}}" method="post">
                @csrf
                <div class="col-4 mt-4">
                    <strong>Nombre del nuevo Rol</strong>
                    <input type="text" name="name" id="name"  class="form-control" style="height:25px; max-width:150px;">
                    <input type="hidden" name="name" id="name" value="web">
                </div>
                <div class=" mt-2" style="display:flex;">
                <ul id="lista">
                    <li>
                        <div class="elemento">
                        <p >Configuración del Portal</p>
                        <label class="expandir">+</label>
                        <div class="detalles">
                            <input type="checkbox" name="permisos[]" value="usuarios.index"> Usuarios
                            <hr>
                            <input type="checkbox" name="permisos[]" value="usuarios.create"> Usuarios - Crear
                            <hr>
                            <input type="checkbox" name="permisos[]" value="usuarios.store"> Usuarios - Guardar
                            <hr>
                            <input type="checkbox" name="permisos[]" value="usuarios.edit"> Usuarios - Editar
                            <hr>
                            <input type="checkbox" name="permisos[]" value="usuarios.update"> Usuarios - Actualizar
                        </div>
                        </div>
                    </li>
                </ul>
                <ul id="lista">
                    <li>
                        <div class="elemento">
                        <p >Tickets</p>
                        <label class="expandir">+</label>
                        <div class="detalles">
                            <input type="checkbox" value=""> Ver total de tickets
                            <br>
                            <input type="checkbox" value=""> Ver Tickets pendientes
                            <br>
                            <input type="checkbox" value=""> Crear Tickets
                            <br>
                            <input type="checkbox" value=""> Editar Tickets
                        </div>
                        </div>
                    </li>
                </ul>
                <ul id="lista" >
                    <li>
                        <div class="elemento">
                        <p>Comodatos</p>
                        <label class="expandir">+</label>
                        <div class="detalles">
                            <input type="checkbox" value=""> Ver total de comodatos
                            <br>
                            <input type="checkbox" value=""> Nuevo Comodato
                            <br>
                            <input type="checkbox" value=""> Editar Comodato
                            <br>
                            <input type="checkbox" value=""> Anular Comodato
                        </div>
                        </div>
                    </li>
                </ul>
                <ul id="lista" >
                    <li>
                        <div class="elemento">
                        <p>Inventario</p>
                        <label class="expandir">+</label>
                        <div class="detalles">
                            <input type="checkbox" value=""> Ver total de insumos
                            <br>
                            <input type="checkbox" value=""> Nuevo Insumo
                            <br>
                            <input type="checkbox" value=""> Editar Insumo
                            <br>
                            <input type="checkbox" value=""> Baja de Insumo
                        </div>
                        </div>
                    </li>
                </ul>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" style="width:100px;">Crear Rol</button>
                    <a href="{{ route('parametros') }}" class="btn btn-primary" style="width:100px; margin-left: 10px;">Volver</a>
                </div>
            </form>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script> 
    $(document).ready(function() {
    // Agregar evento de clic a todos los botones de expandir
    $('.expandir').click(function() {
        // Buscar el elemento padre (div.elemento) del botón clicado
        var elemento = $(this).closest('.elemento');
        // Alternar la visibilidad de los detalles dentro del elemento padre
        elemento.find('.detalles').slideToggle();
        });
    });
</script>
@endsection