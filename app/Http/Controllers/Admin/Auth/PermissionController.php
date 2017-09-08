<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Models\Permission;
use Session;

class PermissionController extends \App\Http\Controllers\Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderBy('id', 'desc')->paginate(10);

        return view('admin.user.permissions')->with('permissions', $permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.permission_create');
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
            'name' => 'required|min:5|max:255|unique:permissions',
            'display_name' => 'required|min:5|max:255',
            'description' => 'required|min:5|max:255',
        ]);

        $permission = New Permission;

        $permission->name = $request->name;
        $permission->display_name = $request->display_name;
        $permission->description = $request->description;

        $permission->save();

        $request->session()->flash('success', 'Great! New permission has been created successfully');

        return redirect()->route('admin.permissions');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);

        return view('admin.user.permission_edit')->with('permission', $permission);
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
            'display_name' => 'required|min:5|max:255',
            'description' => 'required|min:5|max:255',
        ]);

        $permission = Permission::find($id);
        $redirectUrl = $request->redirect_to;

        $permission->display_name = $request->display_name;
        $permission->description = $request->description;

        $permission->save();

        $request->session()->flash('success', 'Great! Permission has been updated successfully');

        return redirect()->to($redirectUrl);
    }

    public function delete($id)
    {
        $permission = Permission::find($id);

        return view('admin.user.permission_delete')->with('permission', $permission);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $permission = Permission::find($id);
        $redirectUrl = $request->redirect_to;

        $permission->roles()->detach();
        $permission->users()->detach();
        $permission->admins()->detach();

        $permission->delete();

        $request->session()->flash('success', 'Great! Permission has been deleted successfully');

        return redirect()->to($redirectUrl);
    }
}
