@extends('portal_it.layouts.base')

@section('content')
<style>
    .detalles {
        display: none;
        /* Ocultar detalles por defecto */
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        /* Espaciar las secciones uniformemente */
    }
</style>

<div class="row">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>
            <svg style="width: 22px; height: 20px;" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"></path>
            </svg>
        </strong>
        Error al editar el ticket, verificar: <br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <h3 class="text-white mt-2">Editar Rol - {{ $role->name }}</h3>
    <form action="{{route('role.update',$role)}}" method="post">
        @method('PUT')
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
                            <th>Tickets</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="color:white; ">
                            <td>All Permissions</td>
                            <td><input type="checkbox" class="general-checkbox" data-section="usuarios" data-group="usuarios" @if($usuarios_all_checked) checked @endif></td>
                            <td><input type="checkbox" class="general-checkbox" data-section="gerencias" data-group="gerencias" @if($gerencias_all_checked) checked @endif></td>
                            <td><input type="checkbox" class="general-checkbox" data-section="puestos" data-group="puestos" @if($puestos_all_checked) checked @endif></td>
                            <td><input type="checkbox" class="general-checkbox" data-section="segmentos" data-group="segmentos" @if($segmentos_all_checked) checked @endif></td>
                            <td><input type="checkbox" class="general-checkbox" data-section="sistemas" data-group="sistemas" @if($sistemas_all_checked) checked @endif></td>
                            <td><input type="checkbox" class="general-checkbox" data-section="problemas" data-group="problemas" @if($problemas_all_checked) checked @endif></td>
                            <td><input type="checkbox" class="general-checkbox" data-section="estados" data-group="estados" @if($estados_all_checked) checked @endif></td>
                            <td><input type="checkbox" class="general-checkbox" data-section="prioridades" data-group="prioridades" @if($prioridades_all_checked) checked @endif></td>
                            <td><input type="checkbox" class="general-checkbox" data-section="proveedores" data-group="proveedores" @if($proveedores_all_checked) checked @endif></td>
                            <td><input type="checkbox" class="general-checkbox" data-section="tecnicos" data-group="tecnicos" @if($tecnicos_all_checked) checked @endif></td>
                            <td><input type="checkbox" class="general-checkbox" data-section="roles" data-group="roles" @if($roles_all_checked) checked @endif></td>
                            <td><input type="checkbox" class="general-checkbox" data-section="tickets" data-group="tickets" @if($tickets_all_checked) checked @endif></td>
                        </tr>
                        <tr style="color:white; ">
                            <td>Index</td>
                            <td><input type="checkbox" name="permisos[]" value="usuarios.index" data-group="usuarios" class="specific-checkbox" @if($permisos_asignados['usuarios.index']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="gerencias.index" data-group="gerencias" class="specific-checkbox" @if($permisos_asignados['gerencias.index']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="puestos.index" data-group="puestos" class="specific-checkbox" @if($permisos_asignados['puestos.index']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="segmentos.index" data-group="segmentos" class="specific-checkbox" @if($permisos_asignados['segmentos.index']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="sistemas.index" data-group="sistemas" class="specific-checkbox" @if($permisos_asignados['sistemas.index']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="problemas.index" data-group="problemas" class="specific-checkbox" @if($permisos_asignados['problemas.index']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="estados.index" data-group="estados" class="specific-checkbox" @if($permisos_asignados['estados.index']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="prioridades.index" data-group="prioridades" class="specific-checkbox" @if($permisos_asignados['prioridades.index']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="proveedores.index" data-group="proveedores" class="specific-checkbox" @if($permisos_asignados['proveedores.index']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="tecnicos.index" data-group="tecnicos" class="specific-checkbox" @if($permisos_asignados['tecnicos.index']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="roles.index" data-group="roles" class="specific-checkbox" @if($permisos_asignados['roles.index']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="tickets.index" data-group="tickets" class="specific-checkbox" @if($permisos_asignados['tickets.index']) checked @endif></td>
                        </tr>
                        <tr style="color:white;">
                            <td>Ver</td>
                            <td><input type="checkbox" name="permisos[]" value="usuarios.show" data-group="usuarios" class="specific-checkbox" @if($permisos_asignados['usuarios.show']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="gerencias.show" data-group="gerencias" class="specific-checkbox" @if($permisos_asignados['gerencias.show']) checked @endif></td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td><input type="checkbox" name="permisos[]" value="proveedores.show" data-group="proveedores" class="specific-checkbox" @if($permisos_asignados['proveedores.show']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="tecnicos.show" data-group="tecnicos" class="specific-checkbox" @if($permisos_asignados['tecnicos.show']) checked @endif></td>
                            <td> - </td>
                            <td><input type="checkbox" name="permisos[]" value="tickets.show" data-group="tickets" class="specific-checkbox" @if($permisos_asignados['tickets.show']) checked @endif></td>
                        </tr>
                        <tr style="color:white;">
                            <td>Crear</td>
                            <td><input type="checkbox" name="permisos[]" value="usuarios.create" data-group="usuarios" class="specific-checkbox" @if($permisos_asignados['usuarios.create']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="gerencias.create" data-group="gerencias" class="specific-checkbox" @if($permisos_asignados['gerencias.create']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="puestos.create" data-group="puestos" class="specific-checkbox" @if($permisos_asignados['puestos.create']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="segmentos.create" data-group="segmentos" class="specific-checkbox" @if($permisos_asignados['segmentos.create']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="sistemas.create" data-group="sistemas" class="specific-checkbox" @if($permisos_asignados['sistemas.create']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="problemas.create" data-group="problemas" class="specific-checkbox" @if($permisos_asignados['problemas.create']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="estados.create" data-group="estados" class="specific-checkbox" @if($permisos_asignados['estados.create']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="prioridades.create" data-group="prioridades" class="specific-checkbox" @if($permisos_asignados['prioridades.create']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="proveedores.create" data-group="proveedores" class="specific-checkbox" @if($permisos_asignados['proveedores.create']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="tecnicos.create" data-group="tecnicos" class="specific-checkbox" @if($permisos_asignados['tecnicos.create']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="roles.create" data-group="roles" class="specific-checkbox" @if($permisos_asignados['roles.create']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="tickets.create" data-group="tickets" class="specific-checkbox" @if($permisos_asignados['tickets.create']) checked @endif></td>
                        </tr>
                        <tr style="color:white;">
                            <td>Guardar</td>
                            <td><input type="checkbox" name="permisos[]" value="usuarios.store" data-group="usuarios" class="specific-checkbox" @if($permisos_asignados['usuarios.store']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="gerencias.store" data-group="gerencias" class="specific-checkbox" @if($permisos_asignados['gerencias.store']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="puestos.store" data-group="puestos" class="specific-checkbox" @if($permisos_asignados['puestos.store']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="segmentos.store" data-group="segmentos" class="specific-checkbox" @if($permisos_asignados['segmentos.store']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="sistemas.store" data-group="sistemas" class="specific-checkbox" @if($permisos_asignados['sistemas.store']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="problemas.store" data-group="problemas" class="specific-checkbox" @if($permisos_asignados['problemas.store']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="estados.store" data-group="estados" class="specific-checkbox" @if($permisos_asignados['estados.store']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="prioridades.store" data-group="prioridades" class="specific-checkbox" @if($permisos_asignados['prioridades.store']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="proveedores.store" data-group="proveedores" class="specific-checkbox" @if($permisos_asignados['proveedores.store']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="tecnicos.store" data-group="tecnicos" class="specific-checkbox" @if($permisos_asignados['tecnicos.store']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="roles.store" data-group="roles" class="specific-checkbox" @if($permisos_asignados['roles.store']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="tickets.store" data-group="tickets" class="specific-checkbox" @if($permisos_asignados['tickets.store']) checked @endif></td>
                        </tr>
                        <tr style="color:white;">
                            <td>Editar</td>
                            <td><input type="checkbox" name="permisos[]" value="usuarios.edit" data-group="usuarios" class="specific-checkbox" @if($permisos_asignados['usuarios.edit']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="gerencias.edit" data-group="gerencias" class="specific-checkbox" @if($permisos_asignados['gerencias.edit']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="puestos.edit" data-group="puestos" class="specific-checkbox" @if($permisos_asignados['puestos.edit']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="segmentos.edit" data-group="segmentos" class="specific-checkbox" @if($permisos_asignados['segmentos.edit']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="sistemas.edit" data-group="sistemas" class="specific-checkbox" @if($permisos_asignados['sistemas.edit']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="problemas.edit" data-group="problemas" class="specific-checkbox" @if($permisos_asignados['problemas.edit']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="estados.edit" data-group="estados" class="specific-checkbox" @if($permisos_asignados['estados.edit']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="prioridades.edit" data-group="prioridades" class="specific-checkbox" @if($permisos_asignados['prioridades.edit']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="proveedores.edit" data-group="proveedores" class="specific-checkbox" @if($permisos_asignados['proveedores.edit']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="tecnicos.edit" data-group="tecnicos" class="specific-checkbox" @if($permisos_asignados['tecnicos.edit']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="roles.edit" data-group="roles" class="specific-checkbox" @if($permisos_asignados['roles.edit']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="tickets.edit" data-group="tickets" class="specific-checkbox" @if($permisos_asignados['tickets.edit']) checked @endif></td>
                        </tr>
                        <tr style="color:white;">
                            <td>Update</td>
                            <td><input type="checkbox" name="permisos[]" value="usuarios.update" data-group="usuarios" class="specific-checkbox" @if($permisos_asignados['usuarios.update']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="gerencias.update" data-group="gerencias" class="specific-checkbox" @if($permisos_asignados['gerencias.update']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="puestos.update" data-group="puestos" class="specific-checkbox" @if($permisos_asignados['puestos.update']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="segmentos.update" data-group="segmentos" class="specific-checkbox" @if($permisos_asignados['segmentos.update']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="sistemas.update" data-group="sistemas" class="specific-checkbox" @if($permisos_asignados['sistemas.update']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="problemas.update" data-group="problemas" class="specific-checkbox" @if($permisos_asignados['problemas.update']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="estados.update" data-group="estados" class="specific-checkbox" @if($permisos_asignados['estados.update']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="prioridades.update" data-group="prioridades" class="specific-checkbox" @if($permisos_asignados['prioridades.update']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="proveedores.update" data-group="proveedores" class="specific-checkbox" @if($permisos_asignados['proveedores.update']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="tecnicos.update" data-group="tecnicos" class="specific-checkbox" @if($permisos_asignados['tecnicos.update']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="roles.update" data-group="roles" class="specific-checkbox" @if($permisos_asignados['roles.update']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="tickets.update" data-group="tickets" class="specific-checkbox" @if($permisos_asignados['tickets.update']) checked @endif></td>
                        </tr>
                        <tr style="color:white;">
                            <td>Delete</td>
                            <td> - </td>
                            <td><input type="checkbox" name="permisos[]" value="gerencias.delete" data-group="gerencias" class="specific-checkbox" @if($permisos_asignados['gerencias.delete']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="puestos.delete" data-group="puestos" class="specific-checkbox" @if($permisos_asignados['puestos.delete']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="segmentos.delete" data-group="segmentos" class="specific-checkbox" @if($permisos_asignados['segmentos.delete']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="sistemas.delete" data-group="sistemas" class="specific-checkbox" @if($permisos_asignados['sistemas.delete']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="problemas.delete" data-group="problemas" class="specific-checkbox" @if($permisos_asignados['problemas.delete']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="estados.delete" data-group="estados" class="specific-checkbox" @if($permisos_asignados['estados.delete']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="prioridades.delete" data-group="prioridades" class="specific-checkbox" @if($permisos_asignados['prioridades.delete']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="proveedores.delete" data-group="proveedores" class="specific-checkbox" @if($permisos_asignados['proveedores.delete']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="tecnicos.delete" data-group="tecnicos" class="specific-checkbox" @if($permisos_asignados['tecnicos.delete']) checked @endif></td>
                            <td><input type="checkbox" name="permisos[]" value="roles.delete" data-group="roles" class="specific-checkbox" @if($permisos_asignados['roles.delete']) checked @endif></td>
                            <td> - </td>
                        </tr>
                        <tr style="color:white;">
                            <td>Tickets Pendientes</td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td><input type="checkbox" name="permisos[]" value="tickets.index.pendiente" data-group="tickets" class="specific-checkbox" @if($permisos_asignados['tickets.index.pendiente']) checked @endif></td>
                        </tr>
                        <tr style="color:white;">
                            <td>Tickets por Gerencia</td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td><input type="checkbox" name="permisos[]" value="tickets.index.gerencia" data-group="tickets" class="specific-checkbox" @if($permisos_asignados['tickets.index.gerencia']) checked @endif></td>
                        </tr>
                        <tr style="color:white;">
                            <td>Tickets Por Gerencia Pendientes</td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                            <td><input type="checkbox" name="permisos[]" value="tickets.index.gerencia.pendientes" data-group="tickets" class="specific-checkbox" @if($permisos_asignados['tickets.index.gerencia.pendientes']) checked @endif></td>
                        </tr>
                        <!-- Continuar con las filas para las demás acciones -->
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="width:100px;">Actualizar</button>
            <a href="{{ route('parametros') }}" class="btn btn-primary" style="width:100px; margin-left: 10px;">Volver</a>
        </div>
    </form>
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


<!-- Sección de Parametros del Portal -->





@endsection