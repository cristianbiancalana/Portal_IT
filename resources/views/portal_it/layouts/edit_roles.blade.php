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
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="color:white; ">
                                <td>All Permissions</td>
                                <td><input type="checkbox" class="general-checkbox" data-section="usuarios" @if($usuarios_all_checked) checked @endif></td>
                                <td><input type="checkbox" class="general-checkbox" data-section="gerencias" @if($gerencias_all_checked) checked @endif></td>
                                <td><input type="checkbox" class="general-checkbox" data-section="puestos" @if($puestos_all_checked) checked @endif></td>
                                <td><input type="checkbox" class="general-checkbox" data-section="segmentos" @if($segmentos_all_checked) checked @endif></td>
                                <td><input type="checkbox" class="general-checkbox" data-section="sistemas" @if($sistemas_all_checked) checked @endif></td>
                                <td><input type="checkbox" class="general-checkbox" data-section="problemas" @if($problemas_all_checked) checked @endif></td>
                                <td><input type="checkbox" class="general-checkbox" data-section="estados" @if($estados_all_checked) checked @endif></td>
                                <td><input type="checkbox" class="general-checkbox" data-section="prioridades" @if($prioridades_all_checked) checked @endif></td>
                                <td><input type="checkbox" class="general-checkbox" data-section="proveedores" @if($proveedores_all_checked) checked @endif></td>
                                <td><input type="checkbox" class="general-checkbox" data-section="tecnicos" @if($tecnicos_all_checked) checked @endif></td>
                                <td><input type="checkbox" class="general-checkbox" data-section="roles" @if($roles_all_checked) checked @endif></td>
                            </tr>
                            <tr style="color:white; ">
                                <td>Index</td>
                                <td><input type="checkbox" name="permisos[]" value="usuarios.index" class="specific-checkbox" @if($permisos_asignados['usuarios.index']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="gerencias.index" class="specific-checkbox" @if($permisos_asignados['gerencias.index']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="puestos.index" class="specific-checkbox" @if($permisos_asignados['puestos.index']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="segmentos.index" class="specific-checkbox" @if($permisos_asignados['segmentos.index']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="sistemas.index" class="specific-checkbox" @if($permisos_asignados['sistemas.index']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="problemas.index" class="specific-checkbox" @if($permisos_asignados['problemas.index']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="estados.index" class="specific-checkbox" @if($permisos_asignados['estados.index']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="prioridades.index" class="specific-checkbox" @if($permisos_asignados['prioridades.index']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="proveedores.index" class="specific-checkbox" @if($permisos_asignados['proveedores.index']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="tecnicos.index" class="specific-checkbox" @if($permisos_asignados['tecnicos.index']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="roles.index" class="specific-checkbox" @if($permisos_asignados['roles.index']) checked @endif></td>
                            </tr>
                            <tr style="color:white;">
                                <td>Ver</td>
                                <td><input type="checkbox" name="permisos[]" value="usuarios.show" class="specific-checkbox" @if($permisos_asignados['usuarios.show']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="gerencias.show" class="specific-checkbox" @if($permisos_asignados['gerencias.show']) checked @endif></td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                                <td><input type="checkbox" name="permisos[]" value="proveedores.show" class="specific-checkbox" @if($permisos_asignados['proveedores.show']) checked @endif></td>
                                <td> - </td>
                                <td> - </td>
                            </tr>
                            <tr style="color:white;">
                                <td>Crear</td>
                                <td><input type="checkbox" name="permisos[]" value="usuarios.create" class="specific-checkbox" @if($permisos_asignados['usuarios.create']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="gerencias.create" class="specific-checkbox" @if($permisos_asignados['gerencias.create']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="puestos.create" class="specific-checkbox" @if($permisos_asignados['puestos.create']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="segmentos.create" class="specific-checkbox" @if($permisos_asignados['segmentos.create']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="sistemas.create" class="specific-checkbox" @if($permisos_asignados['sistemas.create']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="problemas.create" class="specific-checkbox" @if($permisos_asignados['problemas.create']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="estados.create" class="specific-checkbox" @if($permisos_asignados['estados.create']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="prioridades.create" class="specific-checkbox" @if($permisos_asignados['prioridades.create']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="proveedores.create" class="specific-checkbox" @if($permisos_asignados['proveedores.create']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="tecnicos.create" class="specific-checkbox" @if($permisos_asignados['tecnicos.create']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="roles.create" class="specific-checkbox" @if($permisos_asignados['roles.create']) checked @endif></td>
                            </tr>
                            <tr style="color:white;">
                                <td>Guardar</td>
                                <td><input type="checkbox" name="permisos[]" value="usuarios.store" class="specific-checkbox" @if($permisos_asignados['usuarios.store']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="gerencias.store" class="specific-checkbox" @if($permisos_asignados['gerencias.store']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="puestos.store" class="specific-checkbox" @if($permisos_asignados['puestos.store']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="segmentos.store" class="specific-checkbox" @if($permisos_asignados['segmentos.store']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="sistemas.store" class="specific-checkbox" @if($permisos_asignados['sistemas.store']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="problemas.store" class="specific-checkbox" @if($permisos_asignados['problemas.store']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="estados.store" class="specific-checkbox" @if($permisos_asignados['estados.store']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="prioridades.store" class="specific-checkbox" @if($permisos_asignados['prioridades.store']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="proveedores.store" class="specific-checkbox" @if($permisos_asignados['proveedores.store']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="tecnicos.store" class="specific-checkbox" @if($permisos_asignados['tecnicos.store']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="roles.store" class="specific-checkbox" @if($permisos_asignados['roles.store']) checked @endif></td>
                            </tr>
                            <tr style="color:white;">
                                <td>Editar</td>
                                <td><input type="checkbox" name="permisos[]" value="usuarios.edit" class="specific-checkbox" @if($permisos_asignados['usuarios.edit']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="gerencias.edit" class="specific-checkbox" @if($permisos_asignados['gerencias.edit']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="puestos.edit" class="specific-checkbox" @if($permisos_asignados['puestos.edit']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="segmentos.edit" class="specific-checkbox" @if($permisos_asignados['segmentos.edit']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="sistemas.edit" class="specific-checkbox" @if($permisos_asignados['sistemas.edit']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="problemas.edit" class="specific-checkbox" @if($permisos_asignados['problemas.edit']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="estados.edit" class="specific-checkbox" @if($permisos_asignados['estados.edit']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="prioridades.edit" class="specific-checkbox" @if($permisos_asignados['prioridades.edit']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="proveedores.edit" class="specific-checkbox" @if($permisos_asignados['proveedores.edit']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="tecnicos.edit" class="specific-checkbox" @if($permisos_asignados['tecnicos.edit']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="roles.edit" class="specific-checkbox" @if($permisos_asignados['roles.edit']) checked @endif></td>
                            </tr>
                            <tr style="color:white;">
                                <td>Update</td>
                                <td><input type="checkbox" name="permisos[]" value="usuarios.update" class="specific-checkbox" @if($permisos_asignados['usuarios.update']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="gerencias.update" class="specific-checkbox" @if($permisos_asignados['gerencias.update']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="puestos.update" class="specific-checkbox" @if($permisos_asignados['puestos.update']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="segmentos.update" class="specific-checkbox" @if($permisos_asignados['segmentos.update']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="sistemas.update" class="specific-checkbox" @if($permisos_asignados['sistemas.update']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="problemas.update" class="specific-checkbox" @if($permisos_asignados['problemas.update']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="estados.update" class="specific-checkbox" @if($permisos_asignados['estados.update']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="prioridades.update" class="specific-checkbox" @if($permisos_asignados['prioridades.update']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="proveedores.update" class="specific-checkbox" @if($permisos_asignados['proveedores.update']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="tecnicos.update" class="specific-checkbox" @if($permisos_asignados['tecnicos.update']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="roles.update" class="specific-checkbox" @if($permisos_asignados['roles.update']) checked @endif></td>
                            </tr>
                            <tr style="color:white;">
                                <td>Delete</td>
                                <td> - </td>
                                <td><input type="checkbox" name="permisos[]" value="gerencias.delete" class="specific-checkbox" @if($permisos_asignados['gerencias.delete']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="puestos.delete" class="specific-checkbox" @if($permisos_asignados['puestos.delete']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="segmentos.delete" class="specific-checkbox" @if($permisos_asignados['segmentos.delete']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="sistemas.delete" class="specific-checkbox" @if($permisos_asignados['sistemas.delete']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="problemas.delete" class="specific-checkbox" @if($permisos_asignados['problemas.delete']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="estados.delete" class="specific-checkbox" @if($permisos_asignados['estados.delete']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="prioridades.delete" class="specific-checkbox" @if($permisos_asignados['prioridades.delete']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="proveedores.delete" class="specific-checkbox" @if($permisos_asignados['proveedores.delete']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="tecnicos.delete" class="specific-checkbox" @if($permisos_asignados['tecnicos.delete']) checked @endif></td>
                                <td><input type="checkbox" name="permisos[]" value="roles.delete" class="specific-checkbox" @if($permisos_asignados['roles.delete']) checked @endif></td>
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

<!-- Script de JavaScript para la funcionalidad de los checkbox -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('.elemento');

        sections.forEach(section => {
            const generalCheckbox = section.querySelector('.general-checkbox');
            const specificCheckboxes = section.querySelectorAll('.specific-checkbox');
            const details = section.querySelector('.detalles');

            // Eventos para el checkbox general
            generalCheckbox.addEventListener('change', function() {
                specificCheckboxes.forEach(specificCheckbox => {
                    specificCheckbox.checked = generalCheckbox.checked;
                });
            });

            // Eventos para los checkbox específicos
            specificCheckboxes.forEach(specificCheckbox => {
                specificCheckbox.addEventListener('change', function() {
                    // El checkbox general se actualizará según el estado de los checkbox específicos
                    generalCheckbox.checked = Array.from(specificCheckboxes).every(specificCheckbox => specificCheckbox.checked);
                });
            });

            // Expandir o contraer la sección de detalles
            section.querySelector('.expandir').addEventListener('click', function() {
                details.style.display = (details.style.display === 'none') ? 'block' : 'none';
            });
        });
    });
</script>


<!-- Sección de Parametros del Portal -->





@endsection