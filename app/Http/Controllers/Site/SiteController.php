<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;

class SiteController extends \App\Http\Controllers\Controller
{
    protected $postModel;
    protected $categoryModel;
    protected $commenModel;

    public function __construct(Post $postModel, Category $categoryModel, Comment $commentModel)
    {
        $this->postModel = $postModel;
        $this->categoryModel = $categoryModel;
        $this->commentModel = $commentModel;
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

    public function storeComment(Request $request)
    {
        $request->validate([
            'comment' => 'max:500',
            'post' => 'integer',
        ]);

        $this->postModel->storeComment($request);
    }

    public function showComment($id)
    {
        $comment = $this->commentModel->getCommentById($id);

        return view('site.partials._comment', [
            'comment' => $comment,
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
