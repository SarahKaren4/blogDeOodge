<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class SiteUserController extends \App\Http\Controllers\Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(User $userModel)
    {
        $users = $userModel->getUsersList();

        return view('admin.site_user.all', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('admin.site_user.create');
    }

    public function store(Request $request, User $userModel)
    {
        $request->validate([
            'name' => 'required|min:3|max:100|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:60|confirmed',
        ]);

        $userModel->storeUser($request);

        $request->session()->flash('success', __('admin/user.alerts.site_user_store_success'));

        return redirect()->route('admin.users');
    }

    public function show(User $userModel, $id)
    {
        $user = $userModel->getUserById($id);

        return view('admin.site_user.show', [
            'user' => $user,
        ]);
    }

    public function edit(User $userModel, $id)
    {
        $user = $userModel->getUserById($id);

        return view('admin.site_user.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $userModel, $id)
    {
        $request->validate([
            'name' => [
                'required',
                'min:3',
                'max:100',
                Rule::unique('users')->ignore($id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'sometimes|required|min:6|max:60|confirmed',
        ]);

        $userModel->updateUser($request, $id);

        $request->session()->flash('success', __('admin/user.alerts.site_user_update_success'));

        return redirect()->to($request->redirect_to);
    }

    public function delete(User $userModel, $id)
    {
        $user = $userModel->getUserById($id);

        return view('admin.site_user.delete', [
            'user' => $user,
        ]);
    }

    public function destroy(Request $request, User $userModel, $id)
    {
        $userModel->destroyUser($id);

        $request->session()->flash('success', __('admin/user.alerts.site_user_delete_success'));

        return redirect()->to($request->redirect_to);
    }
}
