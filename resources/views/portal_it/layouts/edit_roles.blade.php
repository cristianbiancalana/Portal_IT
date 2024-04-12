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
                        <p >Configuración del Portal</p>
                        <label class="expandir">+</label>
                        <div class="detalles">
                            <!-- <div>
                                <input type="checkbox" name="permisos[]" value="usuarios_ver"
                                    //@if($permisos_asignados['usuarios_ver']) checked @endif>
                                Usuarios - Ver
                            </div> -->
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
                            <!-- Añade más checkboxes según los permisos que desees verificar -->
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