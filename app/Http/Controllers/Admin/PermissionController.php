<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends \App\Http\Controllers\Controller
{

    private $permissionModel;

    public function __construct(Permission $permissionModel){
        $this->middleware('admin');
        $this->middleware('permission:read-permissions')->only(['index']);
        $this->middleware('permission:create-permissions')->only(['create', 'store']);
        $this->middleware('permission:update-permissions')->only(['edit', 'update']);
        $this->middleware('permission:delete-permissions')->only(['delete', 'destroy']);

        $this->permissionModel = $permissionModel;
    }

    public function index()
    {
        $permissions = $this->permissionModel->getPermissionsList();

        return view('admin.permission.all', [
            'permissions' => $permissions,
        ]);
    }

    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name'              => 'required|min:5|max:255|unique:permissions|alpha_dash',
            'display_name'      => 'required|min:5|max:255',
            'description'       => 'required|min:5|max:255',
        ]);

        $this->permissionModel->storePermission($request);

        $request->session()->flash('success', __('admin/user.alerts.permission_store_success'));

        return redirect()->route('admin.permissions');
    }

    public function edit($id)
    {
        $permission = $this->permissionModel->getPermissionById($id);

        return view('admin.permission.edit', [
            'permission' => $permission,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'display_name'  => 'required|min:5|max:255',
            'description'   => 'required|min:5|max:255',
        ]);

        $this->permissionModel->updatePermission($request, $id);

        $request->session()->flash('success', __('admin/user.alerts.permission_update_success'));

        return redirect()->to($request->redirect_to);
    }

    public function delete($id)
    {
        $permission = $this->permissionModel->getPermissionById($id);

        return view('admin.permission.delete', [
            'permission' => $permission,
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $this->permissionModel->destroyPermission($id);

        $request->session()->flash('success', __('admin/user.alerts.permission_delete_success'));

        return redirect()->to($request->redirect_to);
    }
}
