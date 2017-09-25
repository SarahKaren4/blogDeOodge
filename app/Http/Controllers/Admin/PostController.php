<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Validation\Rule;

class PostController extends \App\Http\Controllers\Controller
{
    private $postModel;
    private $categoryModel;

    public function __construct(Post $postModel, Category $categoryModel)
    {
        $this->middleware('admin');
        $this->middleware('permission:read-posts')->only(['index', 'show']);
        $this->middleware('permission:create-posts')->only(['create', 'store']);
        $this->middleware('permission:update-posts')->only(['edit', 'update']);
        $this->middleware('permission:delete-posts')->only(['delete', 'destroy']);

        $this->postModel = $postModel;
        $this->categoryModel = $categoryModel;
    }

    public function index(Request $request)
    {
        $posts = $this->postModel->getPostsList($request);
        $categories = $this->categoryModel->getCategories();

        return view('admin.post.all', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $categories = $this->categoryModel->getCategories();

        return view('admin.post.create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
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

        $this->postModel->storePost($request);

        $request->session()->flash('success', __('admin/blog.alerts.post_store_success'));

        return redirect()->route('admin.posts');
    }

    public function show($id)
    {
        $post = $this->postModel->getPostById($id);

        return view('admin.post.show', [
            'post' => $post,
        ]);
    }

    public function edit($id)
    {
        $post = $this->postModel->getPostById($id);
        $categories = $this->categoryModel->getCategories();
        $checkedCategories = $post->categories->pluck('id')->toArray();

        return view('admin.post.edit', [
            'post' => $post,
            'categories' => $categories,
            'checkedCategories' => $checkedCategories,
        ]);
    }

    public function update(Request $request, $id)
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

        $this->postModel->updatePost($request, $id);

        $request->session()->flash('success', __('admin/blog.alerts.post_update_success'));

        return redirect()->to($request->redirect_to);
    }

    public function delete($id)
    {
        $post = $this->postModel->getPostById($id);

        return view('admin.post.delete', [
            'post' => $post,
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $this->postModel->destroyPost($id);

        $request->session()->flash('success', __('admin/blog.alerts.post_delete_success'));

        return redirect()->to($request->redirect_to);
    }
}
