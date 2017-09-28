<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class SiteUserController extends \App\Http\Controllers\Controller
{
    private $userModel;

    public function __construct(User $userModel)
    {
        $this->middleware('admin');
        $this->middleware('permission:read-users')->only(['index', 'show']);
        $this->middleware('permission:create-users')->only(['create', 'store']);
        $this->middleware('permission:update-users')->only(['edit', 'update']);
        $this->middleware('permission:delete-users')->only(['delete', 'destroy']);

        $this->userModel = $userModel;
    }

    public function index()
    {
        $users = $this->userModel->getUsersList();

        return view('admin.site_user.all', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('admin.site_user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:60|confirmed',
        ]);

        $this->userModel->storeUser($request);

        $request->session()->flash('success', __('admin/user.alerts.site_user_store_success'));

        return redirect()->route('admin.users');
    }

    public function show($id)
    {
        $user = $this->userModel->getUserById($id);

        return view('admin.site_user.show', [
            'user' => $user,
        ]);
    }

    public function edit($id)
    {
        $user = $this->userModel->getUserById($id);

        return view('admin.site_user.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
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

        $this->userModel->updateUser($request, $id);

        $request->session()->flash('success', __('admin/user.alerts.site_user_update_success'));

        return redirect()->to($request->redirect_to);
    }

    public function delete($id)
    {
        $user = $this->userModel->getUserById($id);

        return view('admin.site_user.delete', [
            'user' => $user,
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $this->userModel->destroyUser($id);

        $request->session()->flash('success', __('admin/user.alerts.site_user_delete_success'));

        return redirect()->to($request->redirect_to);
    }
}
