<?php

use App\Http\Controllers\EstadoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Database\Query\IndexHint;
use Illuminate\Support\Facades\Route;
use App\Models\Ticket;
use App\Models\Gerencia;
use App\Models\Puesto;
use App\Models\Problema;
use App\Models\Segmento;
use App\Models\Proveedor;
use App\Models\Sistema;
use App\Models\Estado;
use App\Models\Prioridad;
use App\Models\Tecnico;
use App\Http\Controllers\GerenciaController;
use App\Http\Controllers\PrioridadController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\userController;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Model\User;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SegmentoController;
use App\Http\Controllers\SistemaController;
use App\Http\Controllers\ProblemasController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\TecnicosController;
use Spatie\Permission\Models\Role;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () { //inicio del portal
    return view('portal_it.layouts.home');
});


Route::get('/', function () {
    $gerencias = App\Models\Gerencia::all(); // Obtener todas las gerencias
    $puestos = App\Models\Puesto::all(); // Obtener todos los puestos
    return view('portal_it.layouts.index', compact('gerencias', 'puestos'));
})->name('indexportal');

Route::middleware('auth')->group(function () {


    Route::view('/home', 'portal_it.layouts.home')->name('homeportal');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/archivos/{archivo}', 'ArchivoController@show')->middleware('auth');
    //Solapa parametros
    Route::get('/parametros', function () {
        return view('portal_it.layouts.parametros');
    })->name('parametros');

    //Parametrizaciones del portal- Gerencia
    Route::get('/gerencias', [GerenciaController::class, 'index'])->name('gerencias');
    Route::get('/vista-gerencias', [GerenciaController::class, 'indextabla'])->name('vistagerencias');
    Route::get('/gerencias/create', [GerenciaController::class, 'create'])->name('envio.gerencias');
    Route::post('/gerencias/store', [GerenciaController::class, 'store'])->name('store.gerencias');
    Route::post('/tabla-gerencia', [GerenciaController::class, 'mostrarTablaGerencias'])->name('mostrarTablaGerencias');
    Route::get('/tabla-gerencia', [GerenciaController::class, 'mostrarTablaGerencias'])->name('mostrarTablaGerencias');
    Route::get('/gerencias/{gerencia}/edit', [GerenciaController::class, 'edit'])->name('gerencias.edit');
    Route::put('/gerencias/{gerencia}', [GerenciaController::class, 'update'])->name('gerencias.update');
    Route::delete('/gerencias/{gerencia}', [GerenciaController::class, 'destroy'])->name('gerencias.destroy');
    ////Parametrizaciones del portal- Puestos
    Route::get('/puestos', [PuestoController::class, 'index'])->name('puestos');
    Route::get('/vista-puestos', [PuestoController::class, 'indextabla'])->name('vistapuestos');
    Route::get('/puestos/create', [PuestoController::class, 'create'])->name('envio.puestos');
    Route::post('/puestos/store', [PuestoController::class, 'store'])->name('store.puestos');
    Route::post('/tabla-puestos', [PuestoController::class, 'mostrarTablaPuestos'])->name('mostrarTablaPuestos');
    Route::get('/tabla-puestos', [PuestoController::class, 'mostrarTablaPuestos'])->name('mostrarTablaPuestos');
    Route::get('/puestos/{puesto}/edit', [PuestoController::class, 'edit'])->name('puestos.edit');
    Route::put('/puestos/{puesto}', [PuestoController::class, 'update'])->name('puestos.update');
    Route::delete('/puestos/{puesto}', [PuestoController::class, 'destroy'])->name('puestos.destroy');
    //Parametrizaciones del portal- Segmentos
    Route::get('/segmentos', [SegmentoController::class, 'index'])->name('segmentos');
    Route::get('/vista-segmentos', [SegmentoController::class, 'indextabla'])->name('vistasegmentos');
    Route::get('/segmentos/create', [SegmentoController::class, 'create'])->name('envio.segmentos');
    Route::post('/segmentos/store', [SegmentoController::class, 'store'])->name('store.segmentos');
    Route::post('/tabla-segmentos', [SegmentoController::class, 'mostrarTablaSegmentos'])->name('mostrarTablaSegmentos');
    Route::get('/tabla-segmentos', [SegmentoController::class, 'mostrarTablaSegmentos'])->name('mostrarTablaSegmentos');
    Route::get('/segmentos/{segmento}/edit', [SegmentoController::class, 'edit'])->name('segmentos.edit');
    Route::put('/segmentos/{segmento}', [SegmentoController::class, 'update'])->name('segmentos.update');
    Route::delete('/segmentos/{segmento}', [SegmentoController::class, 'destroy'])->name('segmentos.destroy');
    //Parametrizaciones del portal- Sistemas
    Route::get('/sistemas', [SistemaController::class, 'index'])->name('sistemas');
    Route::get('/vista-sistemas', [SistemaController::class, 'indextabla'])->name('vistasistemas');
    Route::get('/sistemas/create', [SistemaController::class, 'create'])->name('envio.sistemas');
    Route::post('/sistemas/store', [SistemaController::class, 'store'])->name('store.sistemas');
    Route::post('/tabla-sistemas', [SistemaController::class, 'mostrarTablaSistemas'])->name('mostrarTablaSistemas');
    Route::get('/tabla-sistemas', [SistemaController::class, 'mostrarTablaSistemas'])->name('mostrarTablaSistemas');
    Route::get('/sistemas/{sistema}/edit', [SistemaController::class, 'edit'])->name('sistemas.edit');
    Route::put('/sistemas/{sistema}', [SistemaController::class, 'update'])->name('sistemas.update');
    Route::delete('/sistemas/{sistema}', [SistemaController::class, 'destroy'])->name('sistemas.destroy');
    //Parametrizaciones del portal- Problemas
    Route::get('/problemas', [ProblemasController::class, 'index'])->name('problemas');
    Route::get('/vista-problemas', [ProblemasController::class, 'indextabla'])->name('vistaproblemas');
    Route::get('/problemas/create', [ProblemasController::class, 'create'])->name('envio.problemas');
    Route::post('/problemas/store', [ProblemasController::class, 'store'])->name('store.problemas');
    Route::post('/tabla-problemas', [ProblemasController::class, 'mostrarTablaProblemas'])->name('mostrarTablaProblemas');
    Route::get('/tabla-problemas', [ProblemasController::class, 'mostrarTablaProblemas'])->name('mostrarTablaProblemas');
    Route::get('/problemas/{problema}/edit', [ProblemasController::class, 'edit'])->name('problemas.edit');
    Route::put('/problemas/{problema}', [ProblemasController::class, 'update'])->name('problemas.update');
    Route::delete('/problemas/{problema}', [ProblemasController::class, 'destroy'])->name('problemas.destroy');
    //Parametrizaciones del portal- Proveedores
    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores');
    Route::get('/vista-proveedores', [ProveedorController::class, 'indextabla'])->name('vistaproveedores');
    Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('envio.proveedores');
    Route::post('/proveedores/store', [ProveedorController::class, 'store'])->name('store.proveedores');
    Route::post('/tabla-proveedores', [ProveedorController::class, 'mostrarTablaProveedores'])->name('mostrarTablaProveedores');
    Route::get('/tabla-proveedores', [ProveedorController::class, 'mostrarTablaProveedores'])->name('mostrarTablaProveedores');
    Route::get('/proveedores/{proveedor}/view', [ProveedorController::class, 'show'])->name('proveedores.view');
    Route::get('/proveedores/{proveedor}/edit', [ProveedorController::class, 'edit'])->name('proveedores.edit');
    Route::put('/proveedores/{proveedor}', [ProveedorController::class, 'update'])->name('proveedores.update');
    Route::delete('/proveedores/{proveedor}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');
    //Parametrizaciones del portal- Estados
    Route::get('/estados', [EstadoController::class, 'index'])->name('estados');
    Route::get('/vista-estados', [EstadoController::class, 'indextabla'])->name('vistaestados');
    Route::get('/estados/create', [EstadoController::class, 'create'])->name('envio.estados');
    Route::post('/estados/store', [EstadoController::class, 'store'])->name('store.estados');
    Route::post('/tabla-estados', [EstadoController::class, 'mostrarTablaEstados'])->name('mostrarTablaEstados');
    Route::get('/tabla-estados', [EstadoController::class, 'mostrarTablaEstados'])->name('mostrarTablaEstados');
    Route::get('/estados/{estado}/view', [EstadoController::class, 'show'])->name('estados.view');
    Route::get('/estados/{estado}/edit', [EstadoController::class, 'edit'])->name('estados.edit');
    Route::put('/estados/{estado}', [EstadoController::class, 'update'])->name('estados.update');
    Route::delete('/estados/{estado}', [EstadoController::class, 'destroy'])->name('estados.destroy');
    //Parametrizaciones del portal- Prioridades
    Route::get('/prioridades', [PrioridadController::class, 'index'])->name('prioridades');
    Route::get('/vista-prioridades', [PrioridadController::class, 'indextabla'])->name('vistaprioridades');
    Route::get('/prioridades/create', [PrioridadController::class, 'create'])->name('envio.prioridades');
    Route::post('/prioridades/store', [PrioridadController::class, 'store'])->name('store.prioridades');
    Route::post('/tabla-prioridades', [PrioridadController::class, 'mostrarTablaPrioridades'])->name('mostrarTablaPrioridades');
    Route::get('/tabla-prioridades', [PrioridadController::class, 'mostrarTablaPrioridades'])->name('mostrarTablaPrioridades');
    Route::get('/prioridades/{prioridad}/view', [PrioridadController::class, 'show'])->name('prioridades.view');
    Route::get('/prioridades/{prioridad}/edit', [PrioridadController::class, 'edit'])->name('prioridades.edit');
    Route::put('/prioridades/{prioridad}', [PrioridadController::class, 'update'])->name('prioridades.update');
    Route::delete('/prioridades/{prioridad}', [PrioridadController::class, 'destroy'])->name('prioridades.destroy');
    //Parametrizaciones del portal- Tecnicos
    Route::get('/tecnicos', [TecnicosController::class, 'index'])->name('tecnicos');
    Route::get('/vista-tecnicos', [TecnicosController::class, 'indextabla'])->name('vistatecnicos');
    Route::get('/tecnicos/create', [TecnicosController::class, 'create'])->name('envio.tecnicos');
    Route::post('/tecnicos/store', [TecnicosController::class, 'store'])->name('store.tecnicos');
    Route::post('/tabla-tecnicos', [TecnicosController::class, 'mostrarTablaTecnicos'])->name('mostrarTablaTecnicos');
    Route::get('/tabla-tecnicos', [TecnicosController::class, 'mostrarTablaTecnicos'])->name('mostrarTablaTecnicos');
    Route::get('/tecnicos/{tecnico}/view', [TecnicosController::class, 'show'])->name('tecnicos.view');
    Route::get('/tecnicos/{tecnico}/edit', [TecnicosController::class, 'edit'])->name('tecnicos.edit');
    Route::put('/tecnicos/{tecnico}', [TecnicosController::class, 'update'])->name('tecnicos.update');
    Route::delete('/tecnicos/{tecnico}', [TecnicosController::class, 'destroy'])->name('tecnicos.destroy');

    //Parametrizaciones del portal - CRUD de Usuarios
    Route::get('/usuarios', [userController::class, 'index'])->name('usuarios');
    Route::get('/usuarios/{user}/edit', [userController::class, 'edit'])->name('user.edit');
    Route::put('/usuarios/{user}', [userController::class, 'update'])->name('user.update');
    Route::get('/usuarios/create', [userController::class, 'create'])->name('envio.usuarios');
    Route::post('/usuarios/store', [userController::class, 'store'])->name('store.usuarios');
    Route::post('/tabla-usuarios', [userController::class, 'mostrarTablaUsuarios'])->name('mostrarTablaUsuarios');
    Route::get('/tabla-usuarios', [userController::class, 'mostrarTablaUsuarios'])->name('mostrarTablaUsuarios');
    Route::get('/usuarios/{user}/view', [userController::class, 'show'])->name('usuarios.view');
    Route::delete('/usuarios/{user}', [userController::class, 'destroy'])->name('usuarios.destroy');
    //Parametrizaciones del portal - Roles 
    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('role.update');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('envio.roles');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('store.roles');
    Route::post('/tabla-roles', [RoleController::class, 'mostrarTablaRoles'])->name('mostrarTablaRoles');
    Route::get('/tabla-roles', [RoleController::class, 'mostrarTablaRoles'])->name('mostrarTablaRoles');
    Route::get('/roles/{role}/view', [RoleController::class, 'show'])->name('roles.view');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');


    //Solapa tickets
    Route::get('/tickets', [TicketController::class, 'indexall'])->name('totaltickets');
    Route::get('/tickets/pendientes', [TicketController::class, 'indexpendientes'])->name('ticketspendientes'); 
    Route::get('/tickets/new_ticket', [TicketController::class, 'create'])->name('nuevoticket');
    Route::post('/tickets/new_ticket', [TicketController::class, 'store'])->name('nuevo_ticket');
    Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
    Route::get('/tickets/{ticket}/view', [TicketController::class, 'show'])->name('viewticket');
    Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
    //Subida de archivos.
    Route::get('archivos/{archivo}', function ($archivo) {
        $rutaArchivo = storage_path('app/public/archivos/' . $archivo);

        if (file_exists($rutaArchivo)) {
            return response()->file($rutaArchivo);
        } else {
            abort(404);
        }
    })->where('archivo', '.*');
});

require __DIR__ . '/auth.php';
