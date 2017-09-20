<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Validation\Rule;

class PostController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Post $postModel)
    {
        $posts = $postModel->getPostsList();

        return view('admin.post.all', [
            'posts' => $posts,
        ]);
    }

    public function create(Category $categoryModel)
    {
        $categories = $categoryModel->getCategories();

        return view('admin.post.create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request, Post $postModel)
    {
        $validateArray = [
            'slug' => 'required|unique:posts|max:150|regex:/^[a-zA-z0-9\-\_]+$/',
            'published_at' => [
                'required',
                'regex:/^[\d]{2},\s[\d]{2},\s[\d]{4}\s\|\s[\d]{2}:[\d]{2}:[\d]{2}\s[am|pm]{2}$/',
            ],
            'status' => 'required|integer|max:1',
            'categories' => 'required|array',
            'image' => 'image',
        ];

        foreach (config('translatable.locales') as $lang) {
            $validateArray['title-' . $lang] = 'required|max:150';
            $validateArray['description-' . $lang] = 'required';
            $validateArray['meta-title-' . $lang] = 'required|max:150';
            $validateArray['meta-description-' . $lang] = 'required|max:200';
        }

        $request->validate($validateArray);

        $postModel->storePost($request);

        $request->session()->flash('success', __('admin/blog.alerts.post_store_success'));

        return redirect()->route('admin.posts');
    }

    public function show(Post $postModel, $id)
    {
        $post = $postModel->getPostById($id);

        return view('admin.post.show', [
            'post' => $post,
        ]);
    }

    public function edit(Post $postModel, Category $categoryModel, $id)
    {
        $post = $postModel->getPostById($id);
        $categories = $categoryModel->getCategories();
        $checkedCategories = $post->categories->pluck('id')->toArray();

        return view('admin.post.edit', [
            'post' => $post,
            'categories' => $categories,
            'checkedCategories' => $checkedCategories,
        ]);
    }

    public function update(Request $request, Post $postModel, $id)
    {
        $validateArray = [
            'slug' => [
                'required',
                'max:150',
                'regex:/^[a-zA-z0-9\-\_]+$/',
                Rule::unique('posts')->ignore($id),
            ],
            'published_at' => [
                'required',
                'regex:/^[\d]{2},\s[\d]{2},\s[\d]{4}\s\|\s[\d]{2}:[\d]{2}:[\d]{2}\s[am|pm]{2}$/',
            ],
            'status' => 'required|integer|max:1',
            'categories' => 'required|array',
            'image' => 'image',
        ];

        foreach (config('translatable.locales') as $lang) {
            $validateArray['title-' . $lang] = 'required|max:150';
            $validateArray['description-' . $lang] = 'required';
            $validateArray['meta-title-' . $lang] = 'required|max:150';
            $validateArray['meta-description-' . $lang] = 'required|max:200';
        }

        $request->validate($validateArray);

        $postModel->updatePost($request, $id);

        $request->session()->flash('success', __('admin/blog.alerts.post_update_success'));

        return redirect()->to($request->redirect_to);
    }

    public function delete(Post $postModel, $id)
    {
        $post = $postModel->getPostById($id);

        return view('admin.post.delete', [
            'post' => $post,
        ]);
    }

    public function destroy(Request $request, Post $postModel, $id)
    {
        $postModel->destroyPost($id);

        $request->session()->flash('success', __('admin/blog.alerts.post_delete_success'));

        return redirect()->to($request->redirect_to);
    }
}
