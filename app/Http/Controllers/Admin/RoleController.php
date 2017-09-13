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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Role $roleModel)
    {
        $roles = $roleModel->getRolesList();

        return view('admin.role.all', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Permission $permissionModel)
    {

        $permissions = $permissionModel->getPermissions();

        return view('admin.role.create', [
            'permissions' => $permissions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Role $roleModel)
    {
        $request->validate([
            'name'              => 'required|min:3|max:255|unique:roles|alpha_dash',
            'display_name'      => 'required|min:3|max:255',
            'description'       => 'required|min:3|max:255',
            'permissions'       => 'required|Array',
        ]);

        $roleModel->storeRole($request);

        $request->session()->flash('success', 'Great! New role has been created successfully');

        return redirect()->route('admin.roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $roleModel, $id)
    {
        $role = $roleModel->getRoleById($id);

        return view('admin.role.show', [
            'role' => $role,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $roleModel, $id)
    {
        $request->validate([
            'display_name'      => 'required|min:3|max:255',
            'description'       => 'required|min:3|max:255',
            'permissions'       => 'required|Array',
        ]);

        $roleModel->updateRole($request, $id);

        $request->session()->flash('success', 'Great! New role has been updated successfully');

        return redirect()->to($request->redirect_to);
    }

    public function delete(Role $roleModel, $id)
    {
        $role = $roleModel->getRoleById($id);

        return view('admin.role.delete', [
            'role' => $role,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Role $roleModel, $id)
    {
        $roleModel->destroyRole($id);

        $request->session()->flash('success', 'Great! The role has been deleted successfully');

        return redirect()->to($request->redirect_to);
    }
}
