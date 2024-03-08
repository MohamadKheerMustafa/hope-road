<?php

namespace App\Services;

use App\Interfaces\RolesInterface;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesService implements RolesInterface
{
    public function index()
    {
        $Roles = Role::paginate(10);
        return ['data' => $Roles, 'msg' => 'retrived Successfully'];
    }

    public function store($request)
    {
        $role = Role::create(['guard_name' => 'web', 'name' => $request->name]);
        $role->syncPermissions($request->permissions);
        return ['data' => $role, 'msg' => 'Created Successfully'];
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get('name');
        return ['data' => ['Role' => $role, 'rolesPermissions' => $rolePermissions], 'msg' => 'retrived Successfully'];
    }


    public function update($request, $id)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'permission' => 'required',
        // ]);
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        $role->syncPermissions($request->permission);
        return ['data' => $role, 'msg' => 'updated Successfully'];
    }

    public function destroy($id)
    {
        Role::findOrFail($id)->delete();
        return ['data' => null, 'msg' => 'deleted Successfully'];
    }
}
