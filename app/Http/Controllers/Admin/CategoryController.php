<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoryController extends \App\Http\Controllers\Controller
{
    private $categoryModel;

    public function __construct(Category $categoryModel)
    {
        $this->middleware('admin');
        $this->middleware('permission:read-categories')->only(['index', 'show']);
        $this->middleware('permission:create-categories')->only(['create', 'store']);
        $this->middleware('permission:update-categories')->only(['edit', 'update']);
        $this->middleware('permission:delete-categories')->only(['delete', 'destroy']);

        $this->categoryModel = $categoryModel;
    }

    public function index()
    {
        $categories = $this->categoryModel->getCategoriesList();

        return view('admin.category.all', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validateArray = [
            'slug' => 'required|unique:posts|max:150|regex:/^[a-zA-z0-9\-\_]+$/',
            'status' => 'required|integer|max:1',
        ];

        foreach (config('translatable.locales') as $lang) {
            $validateArray['title-' . $lang] = 'required|max:150';
            $validateArray['meta-title-' . $lang] = 'required|max:150';
            $validateArray['meta-description-' . $lang] = 'required|max:200';
        }

        $request->validate($validateArray);

        $this->categoryModel->storeCategory($request);

        $request->session()->flash('success', __('admin/blog.alerts.category_store_success'));

        return redirect()->route('admin.categories');
    }

    public function show($id)
    {
        $category = $this->categoryModel->getCategoryById($id);

        return view('admin.category.show', [
            'category' => $category,
        ]);
    }

    public function edit($id)
    {
        $category = $this->categoryModel->getCategoryById($id);

        return view('admin.category.edit', [
            'category' => $category,
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
            'status' => 'required|integer|max:1',
        ];

        foreach (config('translatable.locales') as $lang) {
            $validateArray['title-' . $lang] = 'required|max:150';
            $validateArray['meta-title-' . $lang] = 'required|max:150';
            $validateArray['meta-description-' . $lang] = 'required|max:200';
        }

        $request->validate($validateArray);

        $this->categoryModel->updateCategory($request, $id);

        $request->session()->flash('success', __('admin/blog.alerts.category_update_success'));

        return redirect()->to($request->redirect_to);
    }

    public function delete($id)
    {
        $category = $this->categoryModel->getCategoryById($id);

        return view('admin.category.delete', [
            'category' => $category,
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $this->categoryModel->destroyCategory($id);

        $request->session()->flash('success', __('admin/blog.alerts.category_delete_success'));

        return redirect()->to($request->redirect_to);
    }
}
