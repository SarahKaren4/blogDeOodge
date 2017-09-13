<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Role $roleModel)
    {
        $roles = $roleModel->getRolesList();

        return view('admin.role.all', [
            'roles' => $roles,
        ]);
    }

    public function create(Permission $permissionModel)
    {

        $permissions = $permissionModel->getPermissions();

        return view('admin.role.create', [
            'permissions' => $permissions,
        ]);
    }

    public function store(Request $request, Role $roleModel)
    {
        $request->validate([
            'name'              => 'required|min:3|max:255|unique:roles|alpha_dash',
            'display_name'      => 'required|min:3|max:255',
            'description'       => 'required|min:3|max:255',
            'permissions'       => 'required|Array',
        ]);

        $roleModel->storeRole($request);

        $request->session()->flash('success', __('admin/user.alerts.role_store_success'));

        return redirect()->route('admin.roles');
    }

    public function show(Role $roleModel, $id)
    {
        $role = $roleModel->getRoleById($id);

        return view('admin.role.show', [
            'role' => $role,
        ]);
    }

    public function edit(Request $request, Role $roleModel, Permission $permissionModel, $id)
    {
        $data = [];

        $role = $roleModel->getRoleById($id);
        $permissions = $permissionModel->getPermissions();
        $checkedPermissions = $role->permissions->pluck('id')->toArray();

        return view('admin.role.edit', [
            'role' => $role,
            'permissions' => $permissions,
            'checkedPermissions' => $checkedPermissions,
        ]);

    }

    public function update(Request $request, Role $roleModel, $id)
    {
        $request->validate([
            'display_name'      => 'required|min:3|max:255',
            'description'       => 'required|min:3|max:255',
            'permissions'       => 'required|Array',
        ]);

        $roleModel->updateRole($request, $id);

        $request->session()->flash('success', __('admin/user.alerts.role_update_success'));

        return redirect()->to($request->redirect_to);
    }

    public function delete(Role $roleModel, $id)
    {
        $role = $roleModel->getRoleById($id);

        return view('admin.role.delete', [
            'role' => $role,
        ]);
    }

    public function destroy(Request $request, Role $roleModel, $id)
    {
        $roleModel->destroyRole($id);

        $request->session()->flash('success', __('admin/user.alerts.role_delete_success'));

        return redirect()->to($request->redirect_to);
    }
}
