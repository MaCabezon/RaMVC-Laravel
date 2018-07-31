<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session,DB;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permissions-list');
        $this->middleware('permission:permissions-show', ['only' => ['show']]);
        $this->middleware('permission:permissions-create', ['only' => ['create','store']]);
        $this->middleware('permission:permissions-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permissions-delete', ['only' => ['destroy']]);
    }

    /**
     * Muestra un listado de los registros.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();

        return view('permissions.index')->with('permissions', $permissions);
    }

    /**
     * Muestra el formulario para la creación de un nuevo registro.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();

        return view('permissions.create')->with('roles', $roles);
    }

    /**
     * Almacena un nuevo registro creado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name'=>'required|max:40',
        ]);

        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $name;

        $roles = $request['roles'];

        $permission->save();

        if (!empty($request['roles']))
        {
            foreach ($roles as $role)
            {
              // Hace coincidir el rol de entrada con el registro de la base de datos
              $r = Role::where('id', '=', $role)->firstOrFail();
              $permission = Permission::where('name', '=', $name)->first();
              $r->givePermissionTo($permission);
            }
        }

        return redirect()->route('permissions.index')
            ->with('flash_message',
             'Permission'. $permission->name.' added!');
    }

    /**
     * Muestra el registro deseado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::find($id);
        $roles = Role::get();

        return view('permissions.show')->with('permission',$permission)->with('roles',$roles);
    }

    /**
     * Muestra el formulario para poder editar un registro especifico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        $roles = Role::get();

        return view('permissions.edit', compact('permission','roles'));
    }

    /**
     * Actualiza un registro específico de la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $this->validate($request, [
            'name'=>'required|max:40',
        ]);

        $input = $request->all();
        if($request->input('roles')!="")
        {
            DB::table('permissions')->where('id', $id)->update(['name' => $input['name']]);
            DB::table('role_has_permissions')->where('permission_id',$id)->delete();
            $permission->assignRole($request->input('roles'));
        }

        return redirect()->route('permissions.index')
            ->with('flash_message',
             'Permission'. $permission->name.' updated!');
    }

    /**
     * Elimina un registro específico de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);

        if ($permission->name == "Administer roles & permissions")
        {
            return redirect()->route('permissions.index')
            ->with('flash_message',
             'Cannot delete this Permission!');
        }

        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('flash_message',
             'Permission deleted!');
    }
}
