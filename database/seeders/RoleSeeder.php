<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'SAdmin']);
        $role2 = Role::create(['name' => 'Admin']);
        $role3 = Role::create(['name' => 'User']);


        //Declaración de Perimisos

        //
        Permission::create(['name' => 'usuarios.edit']);
        Permission::create(['name' => 'usuarios.update']);
        Permission::create(['name' => 'usuarios.create']);
        Permission::create(['name' => 'usuarios.store']);
        Permission::create(['name' => 'usuarios.index']);
        Permission::create(['name' => 'usuarios.show']);
        //
        Permission::create(['name' => 'tickets.edit']);
        Permission::create(['name' => 'tickets.update']);
        Permission::create(['name' => 'tickets.create']);
        Permission::create(['name' => 'tickets.store']);
        Permission::create(['name' => 'tickets.index']);
        Permission::create(['name' => 'tickets.index.pendiente']);
        Permission::create(['name' => 'tickets.index.gerencia']);
        Permission::create(['name' => 'tickets.index.gerencia.pendientes']);
        //
        Permission::create(['name' => 'puestos.edit']);
        Permission::create(['name' => 'puestos.update']);
        Permission::create(['name' => 'puestos.create']);
        Permission::create(['name' => 'puestos.store']);
        Permission::create(['name' => 'puestos.index']);
        Permission::create(['name' => 'puestos.delete']);
        //
        Permission::create(['name' => 'gerencias.edit']);
        Permission::create(['name' => 'gerencias.update']);
        Permission::create(['name' => 'gerencias.create']);
        Permission::create(['name' => 'gerencias.store']);
        Permission::create(['name' => 'gerencias.index']);
        Permission::create(['name' => 'gerencias.show']);
        Permission::create(['name' => 'gerencias.delete']);
        //
        Permission::create(['name' => 'segmentos.edit']);
        Permission::create(['name' => 'segmentos.update']);
        Permission::create(['name' => 'segmentos.create']);
        Permission::create(['name' => 'segmentos.store']);
        Permission::create(['name' => 'segmentos.index']);
        Permission::create(['name' => 'segmentos.delete']);
        //
        Permission::create(['name' => 'sistemas.edit']);
        Permission::create(['name' => 'sistemas.update']);
        Permission::create(['name' => 'sistemas.create']);
        Permission::create(['name' => 'sistemas.store']);
        Permission::create(['name' => 'sistemas.index']);
        Permission::create(['name' => 'sistemas.delete']);
        //
        Permission::create(['name' => 'problemas.edit']);
        Permission::create(['name' => 'problemas.update']);
        Permission::create(['name' => 'problemas.create']);
        Permission::create(['name' => 'problemas.store']);
        Permission::create(['name' => 'problemas.index']);
        Permission::create(['name' => 'problemas.delete']);
        //
        Permission::create(['name' => 'estados.edit']);
        Permission::create(['name' => 'estados.update']);
        Permission::create(['name' => 'estados.create']);
        Permission::create(['name' => 'estados.store']);
        Permission::create(['name' => 'estados.index']);
        Permission::create(['name' => 'estados.delete']);
        //
        Permission::create(['name' => 'proveedores.edit']);
        Permission::create(['name' => 'proveedores.update']);
        Permission::create(['name' => 'proveedores.create']);
        Permission::create(['name' => 'proveedores.store']);
        Permission::create(['name' => 'proveedores.index']);
        Permission::create(['name' => 'proveedores.show']);
        Permission::create(['name' => 'proveedores.delete']);
        //
        Permission::create(['name' => 'prioridades.edit']);
        Permission::create(['name' => 'prioridades.update']);
        Permission::create(['name' => 'prioridades.create']);
        Permission::create(['name' => 'prioridades.store']);
        Permission::create(['name' => 'prioridades.index']);
        Permission::create(['name' => 'prioridades.delete']);
        //
        Permission::create(['name' => 'tecnicos.edit']);
        Permission::create(['name' => 'tecnicos.update']);
        Permission::create(['name' => 'tecnicos.create']);
        Permission::create(['name' => 'tecnicos.store']);
        Permission::create(['name' => 'tecnicos.index']);
        Permission::create(['name' => 'tecnicos.delete']);
        Permission::create(['name' => 'tecnicos.show']);
        //
        Permission::create(['name' => 'roles.edit']);
        Permission::create(['name' => 'roles.update']);
        Permission::create(['name' => 'roles.create']);
        Permission::create(['name' => 'roles.store']);
        Permission::create(['name' => 'roles.index']);
        Permission::create(['name' => 'roles.delete']);

        //Asignación de permisos a roles básicos

        //
        $role1->givePermissionTo('tickets.edit');
        $role1->givePermissionTo('tickets.update');
        $role1->givePermissionTo('tickets.create');
        $role1->givePermissionTo('tickets.store');
        $role1->givePermissionTo('tickets.index');
        $role1->givePermissionTo('tickets.index.pendiente');
        $role1->givePermissionTo('tickets.index.gerencia');
        $role1->givePermissionTo('tickets.index.gerencia.pendientes');
        //
        $role1->givePermissionTo('puestos.edit');
        $role1->givePermissionTo('puestos.update');
        $role1->givePermissionTo('puestos.create');
        $role1->givePermissionTo('puestos.store');
        $role1->givePermissionTo('puestos.index');
        //
        $role1->givePermissionTo('gerencias.edit');
        $role1->givePermissionTo('gerencias.update');
        $role1->givePermissionTo('gerencias.create');
        $role1->givePermissionTo('gerencias.store');
        $role1->givePermissionTo('gerencias.index');
        //
        $role1->givePermissionTo('segmentos.edit');
        $role1->givePermissionTo('segmentos.update');
        $role1->givePermissionTo('segmentos.create');
        $role1->givePermissionTo('segmentos.store');
        $role1->givePermissionTo('segmentos.index');
        //
        $role1->givePermissionTo('sistemas.edit');
        $role1->givePermissionTo('sistemas.update');
        $role1->givePermissionTo('sistemas.create');
        $role1->givePermissionTo('sistemas.store');
        $role1->givePermissionTo('sistemas.index');
        //
        $role1->givePermissionTo('problemas.edit');
        $role1->givePermissionTo('problemas.update');
        $role1->givePermissionTo('problemas.create');
        $role1->givePermissionTo('problemas.store');
        $role1->givePermissionTo('problemas.index');
        //
        $role1->givePermissionTo('estados.edit');
        $role1->givePermissionTo('estados.update');
        $role1->givePermissionTo('estados.create');
        $role1->givePermissionTo('estados.store');
        $role1->givePermissionTo('estados.index');
        //
        $role1->givePermissionTo('proveedores.edit');
        $role1->givePermissionTo('proveedores.update');
        $role1->givePermissionTo('proveedores.create');
        $role1->givePermissionTo('proveedores.store');
        $role1->givePermissionTo('proveedores.index');
        //
        $role1->givePermissionTo('prioridades.edit');
        $role1->givePermissionTo('prioridades.update');
        $role1->givePermissionTo('prioridades.create');
        $role1->givePermissionTo('prioridades.store');
        $role1->givePermissionTo('prioridades.index');
        //
        $role1->givePermissionTo('tecnicos.edit');
        $role1->givePermissionTo('tecnicos.update');
        $role1->givePermissionTo('tecnicos.create');
        $role1->givePermissionTo('tecnicos.store');
        $role1->givePermissionTo('tecnicos.index');
        $role1->givePermissionTo('tecnicos.show');
        //
        $role1->givePermissionTo('roles.edit');
        $role1->givePermissionTo('roles.update');
        $role1->givePermissionTo('roles.create');
        $role1->givePermissionTo('roles.store');
        $role1->givePermissionTo('roles.index');
        $role1->givePermissionTo('roles.delete');
        //
        $role1->givePermissionTo('usuarios.edit');
        $role1->givePermissionTo('usuarios.update');
        $role1->givePermissionTo('usuarios.create');
        $role1->givePermissionTo('usuarios.store');
        $role1->givePermissionTo('usuarios.index');
    }
}
