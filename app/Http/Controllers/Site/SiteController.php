<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class SiteController extends \App\Http\Controllers\Controller
{
    public function __construct(Post $postModel, Category $categoryModel)
    {
        //$this->middleware('auth');

        $this->postModel = $postModel;
        $this->categoryModel = $categoryModel;
    }

    public function index()
    {
        $posts = $this->postModel->getPostsList();
        $categories = $this->categoryModel->getCategories();

        return view('site.home', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    public function showPost($slug)
    {
        $post = $this->postModel->getPostBySlug($slug);

        return view('site.post', [
            'post' => $post,
        ]);
    }

    public function showCategory($slug)
    {
        $category = $this->categoryModel->getCategoryBySlug($slug);
        $posts = $this->categoryModel->getPostsList($category);

        return view('site.category', [
            'category' => $category,
            'posts' => $posts,
        ]);
    }

    public function showContacts()
    {
        return view('site.contacts');
    }

    public function showAboutUs()
    {
        return view('site.about_us');
    }
}
