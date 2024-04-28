@extends('portal_it.layouts.base')

@section('content')
<style>
    .detalles {
        display: none;
        /* Ocultar detalles por defecto */
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
            <div style="display: flex; justify-content: center; margin-top:5px; ">
                {{$roles->links()}}
            </div>
        </div>
    </div>
    <h3 class="text-white">Crear Rol</h3>
    <div style="display:flex; margin-left:15px;">
        <form action="{{route('store.roles')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12 mt-2">
                    <label for="name">Nombre del nuevo rol</label>
                    <input type="text" name="name" id="name" class="form-control" style="height:25px; max-width:150px;">
                    <input type="hidden" name="guard_name" id="guard_name" value="web">
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
                                <td><input type="checkbox" class="general-checkbox" name="usuarios_all" value="usuarios_all" data-group="usuarios"></td>
                                <td><input type="checkbox" class="general-checkbox gerencias" name="gerencias_all" value="gerencias_all" data-group="gerencias"></td>
                                <td><input type="checkbox" class="general-checkbox puestos" name="puestos_all" value="puestos_all" data-group="puestos"></td>
                                <td><input type="checkbox" class="general-checkbox segmentos" name="segmentos_all" value="segmentos_all" data-group="segmentos"></td>
                                <td><input type="checkbox" class="general-checkbox sistemas" name="sistemas_all" value="sistemas_all" data-group="sistemas"></td>
                                <td><input type="checkbox" class="general-checkbox problemas" name="problemas_all" value="problemas_all" data-group="problemas"></td>
                                <td><input type="checkbox" class="general-checkbox estados" name="estados_all" value="estados_all" data-group="estados"></td>
                                <td><input type="checkbox" class="general-checkbox prioridades" name="prioridades_all" value="prioridades_all" data-group="prioridades"></td>
                                <td><input type="checkbox" class="general-checkbox proveedores" name="proveedores_all" value="proveedores_all" data-group="proveedores"></td>
                                <td><input type="checkbox" class="general-checkbox tecnicos" name="tecnicos_all" value="tecnicos_all" data-group="tecnicos"></td>
                                <td><input type="checkbox" class="general-checkbox roles" name="roles_all" value="roles_all" data-group="roles"></td>
                            </tr>
                            <tr style="color:white; ">
                                <td>Index</td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox" value="usuarios.index" data-group="usuarios"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox gerencias" value="gerencias.index" data-group="gerencias"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox puestos" value="puestos.index" data-group="puestos"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox segmentos" value="segmentos.index" data-group="segmentos"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox sistemas" value="sistemas.index" data-group="sistemas"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox problemas" value="problemas.index" data-group="problemas"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox estados" value="estados.index" data-group="estados"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox prioridades" value="prioridades.index" data-group="prioridades"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox proveedores" value="proveedores.index" data-group="proveedores"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox tecnicos" value="tecnicos.index" data-group="tecnicos"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox roles" value="roles.index" data-group="roles"></td>
                            </tr>
                            <tr style="color:white;">
                                <td>Ver</td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox" value="usuarios.show" data-group="usuarios"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox gerencias" value="gerencias.show" data-group="gerencias"></td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox proveedores" value="proveedores.show" data-group="proveedores"></td>
                                <td> - </td>
                                <td> - </td>
                            </tr>
                            <tr style="color:white;">
                                <td>Crear</td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox" value="usuarios.create" data-group="usuarios"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox gerencias" value="gerencias.create" data-group="gerencias"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox puestos" value="puestos.create" data-group="puestos"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox segmentos" value="segmentos.create" data-group="segmentos"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox sistemas" value="sistemas.create" data-group="sistemas"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox problemas" value="problemas.create" data-group="problemas"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox estados" value="estados.create" data-group="estados"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox prioridades" value="prioridades.create" data-group="prioridades"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox proveedores" value="proveedores.create" data-group="proveedores"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox tecnicos" value="tecnicos.create" data-group="tecnicos"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox roles" value="roles.create" data-group="roles"></td>
                            </tr>
                            <tr style="color:white;">
                                <td>Guardar</td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox" value="usuarios.store" data-group="usuarios"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox gerencias" value="gerencias.store" data-group="gerencias"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox puestos" value="puestos.store" data-group="puestos"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox segmentos" value="segmentos.store" data-group="segmentos"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox sistemas" value="sistemas.store" data-group="sistemas"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox problemas" value="problemas.store" data-group="problemas"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox estados" value="estados.store" data-group="estados"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox prioridades" value="prioridades.store" data-group="prioridades"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox proveedores" value="proveedores.store" data-group="proveedores"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox tecnicos" value="tecnicos.store" data-group="tecnicos"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox roles" value="roles.store" data-group="roles"></td>
                            </tr>
                            <tr style="color:white;">
                                <td>Editar</td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox" value="usuarios.edit" data-group="usuarios"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox gerencias" value="gerencias.edit" data-group="gerencias"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox puestos" value="puestos.edit" data-group="puestos"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox segmentos" value="segmentos.edit" data-group="segmentos"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox sistemas" value="sistemas.edit" data-group="sistemas"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox problemas" value="problemas.edit" data-group="problemas"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox estados" value="estados.edit" data-group="estados"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox prioridades" value="prioridades.edit" data-group="prioridades"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox proveedores" value="proveedores.edit" data-group="proveedores"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox tecnicos" value="tecnicos.edit" data-group="tecnicos"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox roles" value="roles.edit" data-group="roles"></td>
                            </tr>
                            <tr style="color:white;">
                                <td>Update</td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox" value="usuarios.update" data-group="usuarios"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox gerencias" value="gerencias.update" data-group="gerencias"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox puestos" value="puestos.update" data-group="puestos"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox segmentos" value="segmentos.update" data-group="segmentos"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox sistemas" value="sistemas.update" data-group="sistemas"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox problemas" value="problemas.update" data-group="problemas"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox estados" value="estados.update" data-group="estados"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox prioridades" value="prioridades.update" data-group="prioridades"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox proveedores" value="proveedores.update" data-group="proveedores"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox tecnicos" value="tecnicos.update" data-group="tecnicos"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox roles" value="roles.update" data-group="roles"></td>
                            </tr>
                            <tr style="color:white;">
                                <td>Delete</td>
                                <td> - </td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox gerencias" value="gerencias.delete" data-group="gerencias"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox puestos" value="puestos.delete" data-group="puestos"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox segmentos" value="segmentos.delete" data-group="segmentos"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox sistemas" value="sistemas.delete" data-group="sistemas"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox problemas" value="problemas.delete" data-group="problemas"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox estados" value="estados.delete" data-group="estados"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox prioridades" value="prioridades.delete" data-group="prioridades"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox proveedores" value="proveedores.delete" data-group="proveedores"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox tecnicos" value="tecnicos.delete" data-group="tecnicos"></td>
                                <td><input type="checkbox" name="permisos[]" class="specific-checkbox roles" value="roles.delete" data-group="roles"></td>
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
        // Evento change para los checkboxes generales
        $('.general-checkbox').change(function() {
            // Obtener el nombre del grupo correspondiente
            var groupName = $(this).attr('data-group');
            console.log("Checkbox general seleccionado. Grupo:", groupName);

            // Obtener todos los checkboxes específicos en el mismo grupo
            var specificCheckboxes = $('input[data-group="' + groupName + '"].specific-checkbox');
            console.log("Checkboxes específicos en el grupo:", specificCheckboxes.length);

            // Si el checkbox general está seleccionado
            if ($(this).is(':checked')) {
                // Seleccionar solo los checkboxes específicos en el mismo grupo
                specificCheckboxes.prop('checked', true);
                console.log("Checkboxes específicos seleccionados.");
            } else {
                // Des-seleccionar solo los checkboxes específicos en el mismo grupo
                specificCheckboxes.prop('checked', false);
                console.log("Checkboxes específicos des-seleccionados.");
            }
        });
    });
</script>

@endsection