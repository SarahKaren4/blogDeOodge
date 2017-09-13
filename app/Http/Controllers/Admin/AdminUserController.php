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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Admin $adminModel)
    {
        $admins = $adminModel->getAdminsList();

        return view('admin.admin_user.all', [
            'admins' => $admins,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Role $roleModel)
    {
        $roles = $roleModel->getRoles();

        return view('admin.admin_user.create', [
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Admin $adminModel)
    {
        $request->validate([
            'name' => 'required|min:3|max:100|unique:admins',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:3|max:60|confirmed',
            'password_confirmation' => 'required',
            'roles' => 'required|array',
        ]);

        $adminModel->storeAdmin($request);

        $request->session()->flash('success', 'Great! New admin user has been created successfully');

        return redirect()->route('admin.admins');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $adminModel, $id)
    {
        $admin = $adminModel->getAdminById($id);

        return view('admin.admin_user.show', [
            'admin' => $admin,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
            'password' => 'sometimes|required|min:3|max:60',
            'password-confirm' => 'required_with:password|same:password',
            'roles' => 'required|array',
        ]);

        $adminModel->updateAdmin($request, $id);

        $request->session()->flash('success', 'Great! The admin user has been updated successfully');

        return redirect()->to($request->redirect_to);
    }

    public function delete(Admin $adminModel, $id)
    {
        $admin = $adminModel->getAdminById($id);

        return view('admin.admin_user.delete', [
            'admin' => $admin,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Admin $adminModel, $id)
    {
        $adminModel->destroyAdmin($id);

        $request->session()->flash('success', 'Great! The admin user has been deleted successfully');

        return redirect()->to($request->redirect_to);
    }
}
