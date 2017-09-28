<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends \App\Http\Controllers\Controller
{
    private $commentModel;

    public function __construct(Comment $commentModel)
    {
        $this->middleware('admin');
        $this->middleware('permission:read-comments')->only(['index']);
        $this->middleware('permission:update-comments')->only(['edit', 'update']);
        $this->middleware('permission:delete-comments')->only(['delete', 'destroy']);

        $this->commentModel = $commentModel;
    }

    public function index()
    {
        $comments = $this->commentModel->getCommentsList();

        return view('admin.comment.all', [
            'comments' => $comments,
        ]);
    }

    public function edit($id)
    {
        $comment = $this->commentModel->getCommentById($id);

        return view('admin.comment.edit', [
            'comment' => $comment,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'max:500',
            'status' => 'integer|max:1'
        ]);

        $this->commentModel->updateComment($request, $id);

        $request->session()->flash('success', __('admin/blog.alerts.comment_update_success'));

        return redirect()->route('admin.comments');
    }

    public function delete($id)
    {
        $comment = $this->commentModel->getCommentById($id);

        return view('admin.comment.delete', [
            'comment' => $comment,
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $this->commentModel->destroyComment($id);

        $request->session()->flash('success', __('admin/blog.alerts.comment_delete_success'));

        return redirect()->to($request->redirect_to);
    }
}
