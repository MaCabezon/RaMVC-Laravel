<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $permissions = [
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'eventos-list',
           'eventos-create',
           'eventos-edit',
           'eventos-delete',
           'transacciones-list',
           'transacciones-create',
           'transacciones-edit',
           'transacciones-delete',
           'resumenAlumnos-list',
           'resumenAlumnos-create',
           'resumenAlumnos-edit',
           'resumenAlumnos-delete',
           'resumenEventos-list',
           'resumenEventos-create',
           'resumenEventos-edit',
           'resumenEventos-delete'          

        ];


        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $user=User::find(1);
        $user->assignRole('admin');

        $role = Role::create(['name' => 'member']);
        $role->givePermissionTo(['resumenAlumnos-list', 'resumenAlumnos-create','resumenAlumnos-edit','resumenAlumnos-delete',
                                'resumenEventos-list','resumenEventos-create','resumenEventos-edit','resumenEventos-delete']);

        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo(['resumenAlumnos-list', 'resumenAlumnos-create','resumenAlumnos-edit','resumenAlumnos-delete',
                                 'resumenEventos-list','resumenEventos-create','resumenEventos-edit','resumenEventos-delete']);

    }
}