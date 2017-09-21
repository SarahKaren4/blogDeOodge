<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends \App\Http\Controllers\Controller
{
    private $adminModel;
    private $roleModel;

    public function __construct(Admin $adminModel, Role $roleModel)
    {
        $this->middleware('admin');
        $this->middleware('permission:read-admins')->only(['index', 'show']);
        $this->middleware('permission:create-admins')->only(['create', 'store']);
        $this->middleware('permission:update-admins')->only(['edit', 'update']);
        $this->middleware('permission:delete-admins')->only(['delete', 'destroy']);

        $this->adminModel = $adminModel;
        $this->roleModel = $roleModel;
    }

    public function index()
    {
        $admins = $this->adminModel->getAdminsList();

        return view('admin.admin_user.all', [
            'admins' => $admins,
        ]);
    }

    public function create()
    {
        $roles = $this->roleModel->getRoles();

        return view('admin.admin_user.create', [
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100|unique:admins',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6|max:60|confirmed',
            'roles' => 'required|array',
        ]);

        $this->adminModel->storeAdmin($request);

        $request->session()->flash('success', __('admin/user.alerts.admin_user_store_success'));

        return redirect()->route('admin.admins');

    }

    public function show($id)
    {
        $admin = $this->adminModel->getAdminById($id);

        return view('admin.admin_user.show', [
            'admin' => $admin,
        ]);
    }

    public function edit($id)
    {
        $admin = $this->adminModel->getAdminById($id);
        $roles = $this->roleModel->getRoles();
        $currentRole = $admin->roles->pluck('id')->toArray();

        $this->authorize('modify', [Admin::class, $admin]);

        return view('admin.admin_user.edit', [
            'admin' => $admin,
            'roles' => $roles,
            'currentRole' => $currentRole,
        ]);
    }

    public function update(Request $request, $id)
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

        $this->adminModel->updateAdmin($request, $id);

        $request->session()->flash('success', __('admin/user.alerts.admin_user_update_success'));

        return redirect()->to($request->redirect_to);
    }

    public function delete($id)
    {
        $admin = $this->adminModel->getAdminById($id);

        $this->authorize('modify', [Admin::class, $admin]);

        return view('admin.admin_user.delete', [
            'admin' => $admin,
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $this->adminModel->destroyAdmin($id);

        $request->session()->flash('success', __('admin/user.alerts.admin_user_delete_success'));

        return redirect()->to($request->redirect_to);
    }
}
