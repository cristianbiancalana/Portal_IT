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

    <div>
    <h3 class="text-white">Editar Rol - {{ $role->name}}</h3>
        <div style="display:flex; margin-left:15px;">
            <form action="{{route('role.update',$role)}}" method="post">
                @method('PUT')
                @csrf
                <div class="col-4 mt-4">
                    <strong>Nombre del nuevo Rol</strong>
                    <input type="text" name="name" id="name"  value="{{ $role->name}}" class="form-control" style="height:25px; max-width:150px;">
                    <input type="hidden" name="guard_name" id="guard_name" value="web">
                </div>
                <div class=" mt-2" style="display:flex;">
                <ul id="lista">
                    <li>
                        <div class="elemento">
                        <p >Usuarios</p>
                        <label class="expandir">+</label>
                        <div class="detalles">
                            <div>
                                <input type="checkbox" name="permisos[]" value="usuarios.index"
                                    @if($permisos_asignados['usuarios.index']) checked @endif>
                                Usuarios
                            </div>
                            <div>
                                <input type="checkbox" name="permisos[]" value="usuarios.show"
                                    @if($permisos_asignados['usuarios.show']) checked @endif>
                                Usuarios - Ver
                            </div>
                            <div>
                                <input type="checkbox" name="permisos[]" value="usuarios.create"
                                    @if($permisos_asignados['usuarios.create']) checked @endif>
                                Usuarios - Crear
                            </div>
                            <div>
                                <input type="checkbox" name="permisos[]" value="usuarios.store"
                                    @if($permisos_asignados['usuarios.store']) checked @endif>
                                Usuarios - Guardar
                            </div>
                            <div>
                                <input type="checkbox" name="permisos[]" value="usuarios.edit"
                                    @if($permisos_asignados['usuarios.edit']) checked @endif>
                                Usuarios - Editar
                            </div>
                            <div>
                                <input type="checkbox" name="permisos[]" value="usuarios.update"
                                    @if($permisos_asignados['usuarios.update']) checked @endif>
                                Usuarios - Actualizar
                            </div>
                        </div>
                    </li>
                </ul>
                <ul id="lista">
                    <li>
                        <div class="elemento">
                            <p>Parametros del Portal</p>
                            <label class="expandir">+</label>
                            <input type="checkbox" class="general-checkbox" data-section="gerencias"  
                                                            @if($gerencias_all_checked) checked @endif> Gerecnias
                            
                            <div class="detalles">
                                <hr>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="gerencias.index" class="specific-checkbox"
                                        @if($permisos_asignados['gerencias.index']) checked @endif>
                                    Gerencias
                                </div>
                                <hr>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="gerencias.show" class="specific-checkbox"
                                        @if($permisos_asignados['gerencias.show']) checked @endif>
                                    Gerencias - Ver
                                </div>
                                <hr>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="gerencias.create" class="specific-checkbox"
                                        @if($permisos_asignados['gerencias.create']) checked @endif>
                                    Gerencias - Crear
                                </div>
                                <hr>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="gerencias.store" class="specific-checkbox"
                                        @if($permisos_asignados['gerencias.store']) checked @endif>
                                    Gerencias - Guardar
                                </div>
                                <hr>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="gerencias.edit" class="specific-checkbox"
                                        @if($permisos_asignados['gerencias.edit']) checked @endif>
                                    Gerencias - Editar
                                </div>
                                <hr>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="gerencias.update" class="specific-checkbox"
                                        @if($permisos_asignados['gerencias.update']) checked @endif>
                                    Gerencias - Actualizar
                                </div>
                                <hr>
                                <div>
                                    <input type="checkbox" name="permisos[]" value="gerencias.delete" class="specific-checkbox"
                                        @if($permisos_asignados['gerencias.delete']) checked @endif>
                                    Gerencias - Delete
                                </div>
                                <!-- Añade otros checkboxes específicos de "Gerencias" según sea necesario -->
                            </div>
                            <hr>
                        </div>
                            <div class="elemento">
                            <label class="expandir">+</label>
                                    <input type="checkbox" class="general-checkbox" data-section="puestos"  
                                                                @if($puestos_all_checked) checked @endif> Puestos
                                <hr>
                                <div class="detalles">
                                    <div>
                                        <input type="checkbox" name="permisos[]" value="puestos.index" class="specific-checkbox"
                                            @if($permisos_asignados['puestos.index']) checked @endif>
                                        Puestos
                                    </div>
                                    <hr>
                                    <div>
                                        <input type="checkbox" name="permisos[]" value="puestos.create" class="specific-checkbox"
                                            @if($permisos_asignados['puestos.create']) checked @endif>
                                        Puestos - Crear
                                    </div>
                                    <hr>
                                    <div>
                                        <input type="checkbox" name="permisos[]" value="puestos.store" class="specific-checkbox"
                                            @if($permisos_asignados['puestos.store']) checked @endif>
                                        Puestos - Guardar
                                    </div>
                                    <hr>
                                    <div>
                                        <input type="checkbox" name="permisos[]" value="puestos.edit" class="specific-checkbox"
                                            @if($permisos_asignados['puestos.edit']) checked @endif>
                                        Puestos - Editar
                                    </div>
                                    <hr>
                                    <div>
                                        <input type="checkbox" name="permisos[]" value="puestos.update" class="specific-checkbox"
                                            @if($permisos_asignados['puestos.update']) checked @endif>
                                        Puestos - Actualizar
                                    </div>
                                    <hr>
                                    <div>
                                        <input type="checkbox" name="permisos[]" value="puestos.delete" class="specific-checkbox"
                                            @if($permisos_asignados['puestos.delete']) checked @endif>
                                        Puestos - Delete
                                    </div>
                                </div>
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
                    <button type="submit" class="btn btn-primary" style="width:100px;">Actualizar</button>
                    <a href="{{ route('parametros') }}" class="btn btn-primary" style="width:100px; margin-left: 10px;">Volver</a>
                </div>
            </form>
        </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script> 
        $(document).ready(function() {
        // Manejo de los botones de expandir
        $('.expandir').click(function() {
            var elemento = $(this).closest('.elemento');
            elemento.find('.detalles').slideToggle();
            console.log('Checkbox específico cambiado en sección:', section);

        });

        // Manejo de los checkboxes específicos
        $('input.specific-checkbox').change(function() {
            // Obtener la sección a la que pertenece este checkbox
            var section = $(this).closest('.elemento');
            
            // Verificar si todos los checkboxes específicos de la sección están marcados
            var allChecked = section.find('input.specific-checkbox').length === section.find('input.specific-checkbox:checked').length;
            
            // Marcar o desmarcar el checkbox general de la sección correspondiente
            section.find('.general-checkbox').prop('checked', allChecked);
        });

        // Manejo de los checkboxes generales
        $('.general-checkbox').change(function() {
            // Obtener la sección que controla este checkbox
            var section = $(this).closest('.elemento');
            
            // Determinar si el checkbox está seleccionado o no
            var isChecked = $(this).is(':checked');
            
            // Seleccionar o deseleccionar todos los checkboxes específicos dentro de la sección correspondiente
            section.find('input.specific-checkbox').prop('checked', isChecked);
        });
    });
</script>
@endsection