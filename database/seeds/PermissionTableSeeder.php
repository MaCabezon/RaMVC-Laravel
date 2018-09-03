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
           'user-show',
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'role-show',           
           'eventos-list',
           'eventos-create',
           'eventos-edit',
           'eventos-delete',
           'eventos-show',
           'permissions-list',
           'permissions-create',
           'permissions-edit',
           'permissions-delete',
           'permissions-show',
           'transacciones-list',
           'transacciones-create',
           'transacciones-edit',
           'transacciones-delete',
           'transacciones-show',
           'resumenAlumnos-list',
           'resumenAlumnos-create',
           'resumenAlumnos-edit',
           'resumenAlumnos-delete',
           'resumenAlumnos-show',
           'resumenEventos-list',
           'resumenEventos-create',
           'resumenEventos-edit',
           'resumenEventos-delete',
           'resumenEventos-show',
           'valoracionesBecarios-list',
           'valoracionesBecarios-create',
           'valoracionesBecarios-edit',
           'valoracionesBecarios-delete',    
           'valoracionesBecarios-show'      

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
                                'resumenEventos-list','resumenEventos-create','resumenEventos-edit','resumenEventos-delete',
                                'valoracionesBecarios-list','valoracionesBecarios-create','valoracionesBecarios-edit',
                                'valoracionesBecarios-delete']);

        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo(['resumenAlumnos-list', 'resumenAlumnos-create','resumenEventos-list']);

    }
}