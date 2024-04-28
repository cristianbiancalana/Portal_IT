
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
                            <a href="{{route('role.edit',$role)}}" style="color:azure;">
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
                {{$roles->links()}}
            </div>
        </div>
        <h3 class="text-white">Crear Rol</h3>
        <div style="display:flex; margin-left:15px;">
            <form action="{{route('store.roles')}}" method="post">
                @csrf
                <div class="row">
            <div class="col-md-12 mt-2">
                <h4 class="mt-3">Permisos</h4>
                    <table class="table table table-sm table-dark mt-3 text-center">
                        <thead>
                            <tr style="color:white;">
                            <th rowspan="2">Permiso | Sección</th>
                            </tr>
                            <tr style="color:white; ">
                                <th>Usuarios</th>
                                <th>Gerencias</th>
                                <th>Puestos</th>
                                <th>Segmentos</th>
                                <th>Sistemas</th>
                                <th>Problemas</th>
                                <th>Estados</th>
                                <th>Prioridades</th>
                                <th>Proveedores</th>
                                <th>Técnicos</th>
                                <th>Roles</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="color:white; ">
                                <td>All Permissions</td>
                                <td><input type="checkbox" class="general-checkbox" name="usuarios_all" value="usuarios_all"></td>
                                <td><input type="checkbox" class="general-checkbox" name="gerencias_all" value="gerencias_all"></td>
                                <td><input type="checkbox" class="general-checkbox" name="puestos_all" value="puestos_all"></td>
                                <td><input type="checkbox" class="general-checkbox" name="segmentos_all" value="segmentos_all"></td>
                                <td><input type="checkbox" class="general-checkbox" name="sistemas_all" value="sistemas_all"></td>
                                <td><input type="checkbox" class="general-checkbox" name="problemas_all" value="problemas_all"></td>
                                <td><input type="checkbox" class="general-checkbox" name="estados_all" value="estados_all"></td>
                                <td><input type="checkbox" class="general-checkbox" name="prioridades_all" value="prioridades_all"></td>
                                <td><input type="checkbox" class="general-checkbox" name="proveedores_all" value="proveedores_all"></td>
                                <td><input type="checkbox" class="general-checkbox" name="tecnicos_all" value="tecnicos_all"></td>
                                <td><input type="checkbox" class="general-checkbox" name="roles_all" value="roles_all"></td>                                
                            </tr>
                            <tr style="color:white; ">
                                <td>Index</td>
                                <td><input type="checkbox" name="permisos[]" value="usuarios.index"></td>
                                <td><input type="checkbox" name="permisos[]" value="gerencias.index"></td>
                                <td><input type="checkbox" name="permisos[]" value="puestos.index"></td>
                                <td><input type="checkbox" name="permisos[]" value="segmentos.index"></td>
                                <td><input type="checkbox" name="permisos[]" value="sistemas.index"></td>
                                <td><input type="checkbox" name="permisos[]" value="problemas.index"></td>
                                <td><input type="checkbox" name="permisos[]" value="estados.index"></td>
                                <td><input type="checkbox" name="permisos[]" value="prioridades.index"></td>
                                <td><input type="checkbox" name="permisos[]" value="proveedores.index"></td>
                                <td><input type="checkbox" name="permisos[]" value="tecnicos.index"></td>
                                <td><input type="checkbox" name="permisos[]" value="roles.index"></td>
                            </tr>
                            <tr style="color:white;">
                                <td>Ver</td>
                                <td><input type="checkbox" name="permisos[]" value="usuarios.show"></td>
                                <td><input type="checkbox" name="permisos[]" value="gerencias.show"></td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td><input type="checkbox" name="permisos[]" value="proveedores.show"></td>
                                <td> - </td>
                                <td> - </td>
                            </tr>
                            <tr style="color:white;">
                                <td>Crear</td>
                                <td><input type="checkbox" name="permisos[]" value="usuarios.create"></td>
                                <td><input type="checkbox" name="permisos[]" value="gerencias.create"></td>
                                <td><input type="checkbox" name="permisos[]" value="puestos.create"></td>
                                <td><input type="checkbox" name="permisos[]" value="segmentos.create"></td>
                                <td><input type="checkbox" name="permisos[]" value="sistemas.create"></td>
                                <td><input type="checkbox" name="permisos[]" value="problemas.create"></td>
                                <td><input type="checkbox" name="permisos[]" value="estados.create"></td>
                                <td><input type="checkbox" name="permisos[]" value="prioridades.create"></td>
                                <td><input type="checkbox" name="permisos[]" value="proveedores.create"></td>
                                <td><input type="checkbox" name="permisos[]" value="tecnicos.create"></td>
                                <td><input type="checkbox" name="permisos[]" value="roles.create"></td>
                            </tr>
                            <tr style="color:white;">
                                <td>Guardar</td>
                                <td><input type="checkbox" name="permisos[]" value="usuarios.store"></td>
                                <td><input type="checkbox" name="permisos[]" value="gerencias.store"></td>
                                <td><input type="checkbox" name="permisos[]" value="puestos.store"></td>
                                <td><input type="checkbox" name="permisos[]" value="segmentos.store"></td>
                                <td><input type="checkbox" name="permisos[]" value="sistemas.store"></td>
                                <td><input type="checkbox" name="permisos[]" value="problemas.store"></td>
                                <td><input type="checkbox" name="permisos[]" value="estados.store"></td>
                                <td><input type="checkbox" name="permisos[]" value="prioridades.store"></td>
                                <td><input type="checkbox" name="permisos[]" value="proveedores.store"></td>
                                <td><input type="checkbox" name="permisos[]" value="tecnicos.store"></td>
                                <td><input type="checkbox" name="permisos[]" value="roles.store"></td>
                            </tr>
                            <tr style="color:white;">
                                <td>Editar</td>
                                <td><input type="checkbox" name="permisos[]" value="usuarios.edit"></td>
                                <td><input type="checkbox" name="permisos[]" value="gerencias.edit"></td>
                                <td><input type="checkbox" name="permisos[]" value="puestos.edit"></td>
                                <td><input type="checkbox" name="permisos[]" value="segmentos.edit"></td>
                                <td><input type="checkbox" name="permisos[]" value="sistemas.edit"></td>
                                <td><input type="checkbox" name="permisos[]" value="problemas.edit"></td>
                                <td><input type="checkbox" name="permisos[]" value="estados.edit"></td>
                                <td><input type="checkbox" name="permisos[]" value="prioridades.edit"></td>
                                <td><input type="checkbox" name="permisos[]" value="proveedores.edit"></td>
                                <td><input type="checkbox" name="permisos[]" value="tecnicos.edit" adif></td>
                                <td><input type="checkbox" name="permisos[]" value="roles.edit"></td>
                            </tr>
                            <tr style="color:white;">
                                <td>Update</td>
                                <td><input type="checkbox" name="permisos[]" value="usuarios.update"></td>
                                <td><input type="checkbox" name="permisos[]" value="gerencias.update"></td>
                                <td><input type="checkbox" name="permisos[]" value="puestos.update"></td>
                                <td><input type="checkbox" name="permisos[]" value="segmentos.update"></td>
                                <td><input type="checkbox" name="permisos[]" value="sistemas.update"></td>
                                <td><input type="checkbox" name="permisos[]" value="problemas.update"></td>
                                <td><input type="checkbox" name="permisos[]" value="estados.update"></td>
                                <td><input type="checkbox" name="permisos[]" value="prioridades.update"></td>
                                <td><input type="checkbox" name="permisos[]" value="proveedores.update"></td>
                                <td><input type="checkbox" name="permisos[]" value="tecnicos.update"></td>
                                <td><input type="checkbox" name="permisos[]" value="roles.update"></td>
                            </tr>
                            <tr style="color:white;">
                                <td>Delete</td>
                                <td> - </td>
                                <td><input type="checkbox" name="permisos[]" value="gerencias.delete"></td>
                                <td><input type="checkbox" name="permisos[]" value="puestos.delete"></td>
                                <td><input type="checkbox" name="permisos[]" value="segmentos.delete"></td>
                                <td><input type="checkbox" name="permisos[]" value="sistemas.delete"></td>
                                <td><input type="checkbox" name="permisos[]" value="problemas.delete"></td>
                                <td><input type="checkbox" name="permisos[]" value="estados.delete"></td>
                                <td><input type="checkbox" name="permisos[]" value="prioridades.delete"></td>
                                <td><input type="checkbox" name="permisos[]" value="proveedores.delete"></td>
                                <td><input type="checkbox" name="permisos[]" value="tecnicos.delete"></td>
                                <td><input type="checkbox" name="permisos[]" value="roles.delete"></td>
                            </tr>
                            <!-- Continuar con las filas para las demás acciones -->
                        </tbody>
                    </table>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="width:100px;">Crear</button>
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
    
    // Evento change para los checkboxes generales
    $('.general-checkbox').change(function() {
        // Buscar el grupo de permisos correspondiente
        var grupo = $(this).closest('.elemento');
        
        // Obtener todos los checkboxes específicos en el grupo
        var specificCheckboxes = grupo.find('.specific-checkbox');
        
        // Si el checkbox general está seleccionado
        if ($(this).is(':checked')) {
            // Seleccionar todos los checkboxes específicos
            specificCheckboxes.prop('checked', true);
        } else {
            // Des-seleccionar todos los checkboxes específicos
            specificCheckboxes.prop('checked', false);
        }
    });
});

</script>
@endsection