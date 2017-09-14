<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function posts()
    {
        return belongsTo('App\Models\Post');
    }

    public function user()
    {
        return $this->morphTo();
    }
}
