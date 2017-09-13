<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends \App\Http\Controllers\Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index(Permission $permissionModel)
    {
        $permissions = $permissionModel->getPermissionsList();

        return view('admin.permission.all', [
            'permissions' => $permissions,
        ]);
    }

    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(Request $request, Permission $permissionModel)
    {

        $request->validate([
            'name'              => 'required|min:5|max:255|unique:permissions|alpha_dash',
            'display_name'      => 'required|min:5|max:255',
            'description'       => 'required|min:5|max:255',
        ]);

        $permissionModel->storePermission($request);

        $request->session()->flash('success', __('admin/user.alerts.permission_store_success'));

        return redirect()->route('admin.permissions');
    }

    public function edit(Permission $permissionModel, $id)
    {
        $permission = $permissionModel->getPermissionById($id);

        return view('admin.permission.edit', [
            'permission' => $permission,
        ]);
    }

    public function update(Request $request, Permission $permissionModel, $id)
    {
        $request->validate([
            'display_name'  => 'required|min:5|max:255',
            'description'   => 'required|min:5|max:255',
        ]);

        $permissionModel->updatePermission($request, $id);

        $request->session()->flash('success', __('admin/user.alerts.permission_update_success'));

        return redirect()->to($request->redirect_to);
    }

    public function delete(Permission $permissionModel, $id)
    {
        $permission = $permissionModel->getPermissionById($id);

        return view('admin.permission.delete', [
            'permission' => $permission,
        ]);
    }

    public function destroy(Request $request, Permission $permissionModel, $id)
    {
        $permissionModel->destroyPermission($id);

        $request->session()->flash('success', __('admin/user.alerts.permission_delete_success'));

        return redirect()->to($request->redirect_to);
    }
}
