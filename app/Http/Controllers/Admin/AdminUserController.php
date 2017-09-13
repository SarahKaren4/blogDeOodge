<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Validation\Rule;

class AdminUserController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Admin $adminModel)
    {
        $admins = $adminModel->getAdminsList();

        return view('admin.admin_user.all', [
            'admins' => $admins,
        ]);
    }

    public function create(Role $roleModel)
    {
        $roles = $roleModel->getRoles();

        return view('admin.admin_user.create', [
            'roles' => $roles,
        ]);
    }

    public function store(Request $request, Admin $adminModel)
    {
        $request->validate([
            'name' => 'required|min:3|max:100|unique:admins',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6|max:60|confirmed',
            'roles' => 'required|array',
        ]);

        $adminModel->storeAdmin($request);

        $request->session()->flash('success', __('admin/user.alerts.admin_user_store_success'));

        return redirect()->route('admin.admins');

    }

    public function show(Admin $adminModel, $id)
    {
        $admin = $adminModel->getAdminById($id);

        return view('admin.admin_user.show', [
            'admin' => $admin,
        ]);
    }

    public function edit(Admin $adminModel, Role $roleModel, $id)
    {
        $admin = $adminModel->getAdminById($id);
        $roles = $roleModel->getRoles();
        $currentRole = $admin->roles->pluck('id')->toArray();

        return view('admin.admin_user.edit', [
            'admin' => $admin,
            'roles' => $roles,
            'currentRole' => $currentRole,
        ]);
    }

    public function update(Request $request, Admin $adminModel, $id)
    {
        $request->validate([
            'name' => [
                'required',
                'min:3',
                'max:100',
                Rule::unique('admins')->ignore($id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('admins')->ignore($id),
            ],
            'password' => 'sometimes|required|min:6|max:60|confirmed',
            'roles' => 'required|array',
        ]);

        $adminModel->updateAdmin($request, $id);

        $request->session()->flash('success', __('admin/user.alerts.admin_user_update_success'));

        return redirect()->to($request->redirect_to);
    }

    public function delete(Admin $adminModel, $id)
    {
        $admin = $adminModel->getAdminById($id);

        return view('admin.admin_user.delete', [
            'admin' => $admin,
        ]);
    }

    public function destroy(Request $request, Admin $adminModel, $id)
    {
        $adminModel->destroyAdmin($id);

        $request->session()->flash('success', __('admin/user.alerts.admin_user_delete_success'));

        return redirect()->to($request->redirect_to);
    }
}
