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
