@extends('portal_it.layouts.base')

@section('content')
    <style>
        .detalles {
            display: none; /* Ocultar detalles por defecto */
        }
        .section-header {
            display: flex;
            justify-content: space-between; /* Espaciar las secciones uniformemente */
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

        <h3 class="text-white">Editar Rol - {{ $role->name }}</h3>
        <form action="{{route('role.update',$role)}}" method="post">
            @method('PUT')
            @csrf
        <div class="section-header">
            <!-- Sección de Usuarios -->
            <div class="col-4">
                <h4>Usuarios</h4>
                <ul id="lista">
                    <li>
                        <div class="elemento">
                            <label class="expandir">+</label>
                            <input type="checkbox" class="general-checkbox" data-section="usuarios" @if($usuarios_all_checked) checked @endif> Usuarios
                            <div class="detalles">
                                <hr>
                                <!-- Opciones de usuarios -->
                                <div>
                                    <input type="checkbox" name="permisos[]" value="usuarios.index" class="specific-checkbox" @if($permisos_asignados['usuarios.index']) checked @endif> Usuarios
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="usuarios.show" class="specific-checkbox" @if($permisos_asignados['usuarios.show']) checked @endif> Usuarios - Ver
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="usuarios.create" class="specific-checkbox" @if($permisos_asignados['usuarios.create']) checked @endif> Usuarios - Crear
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="usuarios.store" class="specific-checkbox" @if($permisos_asignados['usuarios.store']) checked @endif> Usuarios - Guardar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="usuarios.edit" class="specific-checkbox" @if($permisos_asignados['usuarios.edit']) checked @endif> Usuarios - Editar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="usuarios.update" class="specific-checkbox" @if($permisos_asignados['usuarios.update']) checked @endif> Usuarios - Actualizar
                                </div>
                                <!-- Otras opciones de usuarios -->
                                <!-- Continúa con otras opciones -->
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Sección de Parametros del Portal -->
            <div class="col-4">
                <h4>Parametros del Portal</h4>
                <ul id="lista">
                    <!-- Sección de Gerencias -->
                    <li>
                        <div class="elemento">
                            <p>Gerencias</p>
                            <label class="expandir">+</label>
                            <input type="checkbox" class="general-checkbox" data-section="gerencias" @if($gerencias_all_checked) checked @endif> Gerencias
                            <div class="detalles">
                                <hr>
                                <!-- Opciones de gerencias -->
                                <div>
                                    <input type="checkbox" name="permisos[]" value="gerencias.index" class="specific-checkbox" @if($permisos_asignados['gerencias.index']) checked @endif> Gerencias
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="gerencias.show" class="specific-checkbox" @if($permisos_asignados['gerencias.show']) checked @endif> Gerencias - Ver
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="gerencias.create" class="specific-checkbox" @if($permisos_asignados['gerencias.create']) checked @endif> Gerencias - Crear
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="gerencias.store" class="specific-checkbox" @if($permisos_asignados['gerencias.store']) checked @endif> Gerencias - Guardar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="gerencias.edit" class="specific-checkbox" @if($permisos_asignados['gerencias.edit']) checked @endif> Gerencias - Editar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="gerencias.update" class="specific-checkbox" @if($permisos_asignados['gerencias.update']) checked @endif> Gerencias - Actualizar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="gerencias.delete" class="specific-checkbox" @if($permisos_asignados['gerencias.delete']) checked @endif> Gerencias - Delete
                                </div>
                                <!-- Continúa con otras opciones -->
                            </div>
                        </div>
                    </li>

                    <!-- Sección de Puestos -->
                    <li>
                        <div class="elemento">
                            <p>Puestos</p>
                            <label class="expandir">+</label>
                            <input type="checkbox" class="general-checkbox" data-section="puestos" @if($puestos_all_checked) checked @endif> Puestos
                            <div class="detalles">
                                <hr>
                                <!-- Opciones de puestos -->
                                <div>
                                    <input type="checkbox" name="permisos[]" value="puestos.index" class="specific-checkbox" @if($permisos_asignados['puestos.index']) checked @endif> Puestos
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="puestos.create" class="specific-checkbox" @if($permisos_asignados['puestos.create']) checked @endif> Puestos - Crear
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="puestos.store" class="specific-checkbox" @if($permisos_asignados['puestos.store']) checked @endif> Puestos - Guardar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="puestos.edit" class="specific-checkbox" @if($permisos_asignados['puestos.edit']) checked @endif> Puestos - Editar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="puestos.update" class="specific-checkbox" @if($permisos_asignados['puestos.update']) checked @endif> Puestos - Actualizar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="puestos.delete" class="specific-checkbox" @if($permisos_asignados['puestos.delete']) checked @endif> Puestos - Delete
                                </div>
                                <!-- Continúa con otras opciones -->
                            </div>
                        </div>
                    </li>
                    <!-- Sección de Segmentos -->
                    <li>
                        <div class="elemento">
                            <p>Segmentos</p>
                            <label class="expandir">+</label>
                            <input type="checkbox" class="general-checkbox" data-section="segmentos" @if($segmentos_all_checked) checked @endif> Segmentos
                            <div class="detalles">
                                <hr>
                                <!-- Opciones de segmentos -->
                                <div>
                                    <input type="checkbox" name="permisos[]" value="segmentos.index" class="specific-checkbox" @if($permisos_asignados['segmentos.index']) checked @endif> Segmentos
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="segmentos.create" class="specific-checkbox" @if($permisos_asignados['segmentos.create']) checked @endif> Segmentos - Crear
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="segmentos.store" class="specific-checkbox" @if($permisos_asignados['segmentos.store']) checked @endif> Segmentos - Guardar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="segmentos.edit" class="specific-checkbox" @if($permisos_asignados['segmentos.edit']) checked @endif> Segmentos - Editar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="segmentos.update" class="specific-checkbox" @if($permisos_asignados['segmentos.update']) checked @endif> Segmentos - Actualizar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="segmentos.delete" class="specific-checkbox" @if($permisos_asignados['segmentos.delete']) checked @endif> Segmentos - Delete
                                </div>
                                <!-- Continúa con otras opciones -->
                            </div>
                        </div>
                    </li>
                    <!-- Sección de Sistemas -->
                    <li>
                        <div class="elemento">
                            <p>Sistemas</p>
                            <label class="expandir">+</label>
                            <input type="checkbox" class="general-checkbox" data-section="sistemas" @if($sistemas_all_checked) checked @endif> Sistemas
                            <div class="detalles">
                                <hr>
                                <!-- Opciones de sistemas -->
                                <div>
                                    <input type="checkbox" name="permisos[]" value="sistemas.index" class="specific-checkbox" @if($permisos_asignados['sistemas.index']) checked @endif> Sistemas
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="sistemas.create" class="specific-checkbox" @if($permisos_asignados['sistemas.create']) checked @endif> Sistemas - Crear
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="sistemas.store" class="specific-checkbox" @if($permisos_asignados['sistemas.store']) checked @endif> Sistemas - Guardar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="sistemas.edit" class="specific-checkbox" @if($permisos_asignados['sistemas.edit']) checked @endif> Sistemas - Editar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="sistemas.update" class="specific-checkbox" @if($permisos_asignados['sistemas.update']) checked @endif> Sistemas - Actualizar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="sistemas.delete" class="specific-checkbox" @if($permisos_asignados['sistemas.delete']) checked @endif> Sistemas - Delete
                                </div>
                                <!-- Continúa con otras opciones -->
                            </div>
                        </div>
                    </li>
                    <!-- Sección de Problemas -->
                    <li>
                        <div class="elemento">
                            <p>Problemas</p>
                            <label class="expandir">+</label>
                            <input type="checkbox" class="general-checkbox" data-section="problemas" @if($problemas_all_checked) checked @endif> Problemas
                            <div class="detalles">
                                <hr>
                                <!-- Opciones de problemas -->
                                <div>
                                    <input type="checkbox" name="permisos[]" value="problemas.index" class="specific-checkbox" @if($permisos_asignados['problemas.index']) checked @endif> Problemas
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="problemas.create" class="specific-checkbox" @if($permisos_asignados['problemas.create']) checked @endif> Problemas - Crear
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="problemas.store" class="specific-checkbox" @if($permisos_asignados['problemas.store']) checked @endif> Problemas - Guardar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="problemas.edit" class="specific-checkbox" @if($permisos_asignados['problemas.edit']) checked @endif> Problemas - Editar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="problemas.update" class="specific-checkbox" @if($permisos_asignados['problemas.update']) checked @endif> Problemas - Actualizar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="problemas.delete" class="specific-checkbox" @if($permisos_asignados['problemas.delete']) checked @endif> Problemas - Delete
                                </div>
                                <!-- Continúa con otras opciones -->
                            </div>
                        </div>
                    </li>
                    <!-- Sección de Estados -->
                    <li>
                        <div class="elemento">
                            <p>Estados</p>
                            <label class="expandir">+</label>
                            <input type="checkbox" class="general-checkbox" data-section="estados" @if($estados_all_checked) checked @endif> Estados
                            <div class="detalles">
                                <hr>
                                <!-- Opciones de prioridades -->
                                <div>
                                    <input type="checkbox" name="permisos[]" value="estados.index" class="specific-checkbox" @if($permisos_asignados['estados.index']) checked @endif> Estados
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="estados.create" class="specific-checkbox" @if($permisos_asignados['estados.create']) checked @endif> Estados - Crear
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="estados.store" class="specific-checkbox" @if($permisos_asignados['estados.store']) checked @endif> Estados - Guardar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="estados.edit" class="specific-checkbox" @if($permisos_asignados['estados.edit']) checked @endif> Estados - Editar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="estados.update" class="specific-checkbox" @if($permisos_asignados['estados.update']) checked @endif> Estados - Actualizar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="estados.delete" class="specific-checkbox" @if($permisos_asignados['estados.delete']) checked @endif> Estados - Delete
                                </div>
                                <!-- Continúa con otras opciones -->
                            </div>
                        </div>
                    </li>
                    <!-- Sección de Prioridades -->
                    <li>
                        <div class="elemento">
                            <p>Prioridades</p>
                            <label class="expandir">+</label>
                            <input type="checkbox" class="general-checkbox" data-section="prioridades" @if($prioridades_all_checked) checked @endif> Prioridades
                            <div class="detalles">
                                <hr>
                                <!-- Opciones de prioridades -->
                                <div>
                                    <input type="checkbox" name="permisos[]" value="prioridades.index" class="specific-checkbox" @if($permisos_asignados['prioridades.index']) checked @endif> Prioridades
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="prioridades.create" class="specific-checkbox" @if($permisos_asignados['prioridades.create']) checked @endif> Prioridades - Crear
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="prioridades.store" class="specific-checkbox" @if($permisos_asignados['prioridades.store']) checked @endif> Prioridades - Guardar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="prioridades.edit" class="specific-checkbox" @if($permisos_asignados['prioridades.edit']) checked @endif> Prioridades - Editar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="prioridades.update" class="specific-checkbox" @if($permisos_asignados['prioridades.update']) checked @endif> Prioridades - Actualizar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="prioridades.delete" class="specific-checkbox" @if($permisos_asignados['prioridades.delete']) checked @endif> Prioridades - Delete
                                </div>
                                <!-- Continúa con otras opciones -->
                            </div>
                        </div>
                    </li>
                    <!-- Sección de Proveedores -->
                    <li>
                        <div class="elemento">
                            <p>Proveedores</p>
                            <label class="expandir">+</label>
                            <input type="checkbox" class="general-checkbox" data-section="proveedores" @if($proveedores_all_checked) checked @endif> Proveedores
                            <div class="detalles">
                                <hr>
                                <!-- Opciones de proveedores -->
                                <div>
                                    <input type="checkbox" name="permisos[]" value="proveedores.index" class="specific-checkbox" @if($permisos_asignados['proveedores.index']) checked @endif> Proveedores
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="proveedores.show" class="specific-checkbox" @if($permisos_asignados['proveedores.show']) checked @endif> Proveedores - Ver
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="proveedores.create" class="specific-checkbox" @if($permisos_asignados['proveedores.create']) checked @endif> Proveedores - Crear
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="proveedores.store" class="specific-checkbox" @if($permisos_asignados['proveedores.store']) checked @endif> Proveedores - Guardar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="proveedores.edit" class="specific-checkbox" @if($permisos_asignados['proveedores.edit']) checked @endif> Proveedores - Editar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="proveedores.update" class="specific-checkbox" @if($permisos_asignados['proveedores.update']) checked @endif> Proveedores - Actualizar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="proveedores.delete" class="specific-checkbox" @if($permisos_asignados['proveedores.delete']) checked @endif> Proveedores - Delete
                                </div>
                                <!-- Continúa con otras opciones -->
                            </div>
                        </div>
                    </li>
                    <!-- Sección de Técnicos -->
                    <li>
                        <div class="elemento">
                            <p>Técnicos</p>
                            <label class="expandir">+</label>
                            <input type="checkbox" class="general-checkbox" data-section="tecnicos" @if($tecnicos_all_checked) checked @endif> Técnicos
                            <div class="detalles">
                                <hr>
                                <!-- Opciones de tecnicos -->
                                <div>
                                    <input type="checkbox" name="permisos[]" value="tecnicos.index" class="specific-checkbox" @if($permisos_asignados['tecnicos.index']) checked @endif> Técnicos
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="tecnicos.create" class="specific-checkbox" @if($permisos_asignados['tecnicos.create']) checked @endif> Técnicos - Crear
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="tecnicos.store" class="specific-checkbox" @if($permisos_asignados['tecnicos.store']) checked @endif> Técnicos - Guardar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="tecnicos.edit" class="specific-checkbox" @if($permisos_asignados['tecnicos.edit']) checked @endif> Técnicos - Editar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="tecnicos.update" class="specific-checkbox" @if($permisos_asignados['tecnicos.update']) checked @endif> Técnicos - Actualizar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="tecnicos.delete" class="specific-checkbox" @if($permisos_asignados['tecnicos.delete']) checked @endif> Técnicos - Delete
                                </div>
                                <!-- Continúa con otras opciones -->
                            </div>
                        </div>
                    </li>
                    <!-- Sección de Roles -->
                    <li>
                        <div class="elemento">
                            <p>Roles</p>
                            <label class="expandir">+</label>
                            <input type="checkbox" class="general-checkbox" data-section="roles" @if($roles_all_checked) checked @endif> Roles
                            <div class="detalles">
                                <hr>
                                <!-- Opciones de roles-->
                                <div>
                                    <input type="checkbox" name="permisos[]" value="roles.index" class="specific-checkbox" @if($permisos_asignados['roles.index']) checked @endif> Roles
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="roles.create" class="specific-checkbox" @if($permisos_asignados['roles.create']) checked @endif> Roles - Crear
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="roles.store" class="specific-checkbox" @if($permisos_asignados['roles.store']) checked @endif> Roles - Guardar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="roles.edit" class="specific-checkbox" @if($permisos_asignados['roles.edit']) checked @endif> Roles - Editar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="roles.update" class="specific-checkbox" @if($permisos_asignados['roles.update']) checked @endif> Roles - Actualizar
                                </div>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="roles.delete" class="specific-checkbox" @if($permisos_asignados['roles.delete']) checked @endif> Roles - Delete
                                </div>
                                <!-- Continúa con otras opciones -->
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Sección de Tickets -->
            <div class="col-4">
                <h4>Tickets</h4>
                <ul id="lista">
                    <li>
                        <div class="elemento">
                            <label class="expandir">+</label>
                            <input type="checkbox" class="general-checkbox" data-section="tickets"> Tickets
                            <div class="detalles">
                                <!-- Opciones de tickets -->
                                <div>
                                    <input type="checkbox" name="permisos[]" value="" class="specific-checkbox" checked> Ver total de tickets
                                </div>
                                <!-- Continúa con otras opciones -->
                            </div>
                        </div>
                    </li>
                </ul>
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
@endsection
