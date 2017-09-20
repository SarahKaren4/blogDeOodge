<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoryController extends \App\Http\Controllers\Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Category $categoryModel)
    {
        $categories = $categoryModel->getCategoriesList();

        return view('admin.category.all', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request, Category $categoryModel)
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

        $categoryModel->storeCategory($request);

        $request->session()->flash('success', __('admin/blog.alerts.category_store_success'));

        return redirect()->route('admin.categories');
    }

    public function show(Category $categoryModel, $id)
    {
        $category = $categoryModel->getCategoryById($id);

        return view('admin.category.show', [
            'category' => $category,
        ]);
    }

    public function edit(Category $categoryModel, $id)
    {
        $category = $categoryModel->getCategoryById($id);

        return view('admin.category.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $categoryModel, $id)
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

        $categoryModel->updateCategory($request, $id);

        $request->session()->flash('success', __('admin/blog.alerts.category_update_success'));

        return redirect()->to($request->redirect_to);
    }

    public function delete(Category $categoryModel, $id)
    {
        $category = $categoryModel->getCategoryById($id);

        return view('admin.category.delete', [
            'category' => $category,
        ]);
    }

    public function destroy(Request $request, Category $categoryModel, $id)
    {
        $categoryModel->destroyCategory($id);

        $request->session()->flash('success', __('admin/blog.alerts.category_delete_success'));

        return redirect()->to($request->redirect_to);
    }
}
