<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends \App\Http\Controllers\Controller
{
    private $permissionModel;
    private $roleModel;

    public function __construct(Permission $permissionModel, Role $roleModel)
    {
        $this->middleware('admin');
        $this->middleware('permission:read-roles')->only(['index', 'show']);
        $this->middleware('permission:create-roles')->only(['create', 'store']);
        $this->middleware('permission:update-roles')->only(['edit', 'update']);
        $this->middleware('permission:delete-roles')->only(['delete', 'destroy']);

        $this->permissionModel = $permissionModel;
        $this->roleModel = $roleModel;
    }

    public function index(Role $roleModel)
    {
        $roles = $roleModel->getRolesList();

        return view('admin.role.all', [
            'roles' => $roles,
        ]);
    }

    public function create()
    {

        $permissions = $this->permissionModel->getPermissions();

        return view('admin.role.create', [
            'permissions' => $permissions,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|min:3|max:255|unique:roles|alpha_dash',
            'display_name'      => 'required|min:3|max:255',
            'description'       => 'required|min:3|max:255',
            'permissions'       => 'required|Array',
        ]);

        $this->roleModel->storeRole($request);

        $request->session()->flash('success', __('admin/user.alerts.role_store_success'));

        return redirect()->route('admin.roles');
    }

    public function show($id)
    {
        $role = $this->roleModel->getRoleById($id);

        return view('admin.role.show', [
            'role' => $role,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $data = [];

        $role = $this->roleModel->getRoleById($id);
        $permissions = $this->permissionModel->getPermissions();
        $checkedPermissions = $role->permissions->pluck('id')->toArray();

        return view('admin.role.edit', [
            'role' => $role,
            'permissions' => $permissions,
            'checkedPermissions' => $checkedPermissions,
        ]);

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'display_name'      => 'required|min:3|max:255',
            'description'       => 'required|min:3|max:255',
            'permissions'       => 'required|Array',
        ]);

        $this->roleModel->updateRole($request, $id);

        $request->session()->flash('success', __('admin/user.alerts.role_update_success'));

        return redirect()->to($request->redirect_to);
    }

    public function delete($id)
    {
        $role = $this->roleModel->getRoleById($id);

        return view('admin.role.delete', [
            'role' => $role,
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $this->roleModel->destroyRole($id);

        $request->session()->flash('success', __('admin/user.alerts.role_delete_success'));

        return redirect()->to($request->redirect_to);
    }
}
