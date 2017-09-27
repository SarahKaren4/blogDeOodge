<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\NewComment;

class Comment extends Model
{
    protected $fillable = [
        'comment', 'user_id', 'user_type', 'status'
    ];

    public function getCommentsList()
    {
        return $this->sort()->paginate(10);
    }

    public function getCommentById($id)
    {
        return $this->findOrFail($id);
    }

    public function updateComment($request, $id)
    {
        $comment = $this->getCommentById($id);

        $oldStatus = $comment->status;

        $comment->comment = $request->comment;
        $comment->status = $request->status;

        $comment->touch();
        $comment->save();
    }

    public function destroyComment($id)
    {
        $comment = $this->getCommentById($id);
        $comment->delete();
    }

    public function scopeSort($query)
    {
        $query->latest('id');
    }

    public function getCreatedAtAttribute($value)
    {
        return date('j, m, Y | g:i:s a', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('j, m, Y | g:i:s a', strtotime($value));
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    public function user()
    {
        return $this->morphTo();
    }
}
