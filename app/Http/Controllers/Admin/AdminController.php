<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Role;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;

class AdminController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.home', [
            'countAdmins' => Admin::all()->count(),
            'countUsers' => User::all()->count(),
            'countRoles' => Role::all()->count(),
            'countPosts' => Post::all()->count(),
            'countCategories' => Category::all()->count(),
            'countComments' => Comment::all()->count(),
        ]);
    }
}
