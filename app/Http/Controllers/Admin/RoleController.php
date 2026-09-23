<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    // list roles
    public function index()
    {
        $roles = Role::all();
        return view("admin.role.index", ["roles" => $roles]);
    }

    // form view create role
    public function create()
    {
        return view("admin.role.create");
    }

    // store role DB
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required"
        ], [
            "name.required" => "Vui lòng nhập tên quyền"
        ]);

        $role = new Role();
        $role->name = $data["name"];
        $role->save();

        request()->session()->put("success", "Thêm mới thành công " .$role->name);
        return redirect()->route('admin.role.index');
    }

    // form view edit role
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view("admin.role.edit", ["role" => $role]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            "name" => "required"
        ], [
            "name.required" => "Vui lòng nhập tên quyền"
        ]);

        $role = Role::findOrFail($id);
        $role->update($data);

        request()->session()->put("success", "Cập nhật thành công " .$role->name);
        return redirect()->route('admin.role.index');
    }

    // list role action
    public function listRoleAction($id)
    {
        $role = Role::findOrFail($id);
        $actions = Permission::all();

        $selectedAction = [];
        foreach ($role->permissions as $action) {
            array_push($selectedAction, $action->id);
        }

        return view("admin.role.listRoleAction", compact("role", "actions", "selectedAction"));
    }

    public function updateRoleAction(Request $request, $roleId)
    {
        // get roleId
        $role = Role::find($roleId);

        // delete role_id in table (revoke permissions)
        PermissionRole::where("role_id", $roleId)->delete();

        // insert role_id and permission_id (grant permissions)
        $action_ids = $request->action_ids;
        if(!empty($action_ids)) {
            foreach ($action_ids as $action_id) {
                PermissionRole::create([
                    "role_id" => $roleId,
                    "permission_id" => $action_id
                ]);
            }
        }

        request()->session()->put("success", "Cấp quyền thành công cho " .$role->name);
        return redirect()->route('admin.role.index');
    }
}
