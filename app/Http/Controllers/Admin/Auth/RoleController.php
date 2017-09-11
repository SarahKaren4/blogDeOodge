<?php

namespace App\Http\Controllers\Admin\Auth;

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
    public function index()
    {
        $roles = Role::orderBy('name')->paginate(10);

        return view('admin.role.all')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $permissions = Permission::orderBy('id', 'desc')->get();

        return view('admin.role.create')->with('permissions', $permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|min:3|max:255|unique:roles|alpha_dash',
            'display_name'      => 'required|min:3|max:255',
            'description'       => 'required|min:3|max:255',
            'permissions'       => 'required|Array',
        ]);

        $role = New Role();

        $role->name = strtolower($request->name);
        $role->display_name = $request->display_name;
        $role->description = $request->description;

        $role->save();

        $role->permissions()->attach($request->permissions);

        $request->session()->flash('success', 'Great! New role has been created successfully');

        return redirect()->route('admin.roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);

        return view('admin.role.show')->with('role', $role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data = [];

        $role = Role::findOrFail($id);
        $permissions = Permission::orderBy('id', 'desc')->get();
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'display_name'      => 'required|min:3|max:255',
            'description'       => 'required|min:3|max:255',
            'permissions'       => 'required|Array',
        ]);

        $role = Role::findorFail($id);
        $redirectTo = $request->redirect_to;

        $role->display_name = $request->display_name;
        $role->description = $request->description;

        $role->save();
        $role->permissions()->sync($request->permissions);

        $request->session()->flash('success', 'Great! New role has been updated successfully');

        return redirect()->to($redirectTo);
    }

    public function delete($id)
    {
        $role = Role::findOrfail($id);

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
    public function destroy(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $redirectTo = $request->redirect_to;

        $role->permissions()->detach();
        $role->users()->detach();
        $role->admins()->detach();

        $role->delete();

        $request->session()->flash('success', 'Great! The role has been deleted successfully');

        return redirect()->to($redirectTo);
    }
}
