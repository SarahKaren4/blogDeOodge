<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function getPostsList()
    {
        return $this->sort()->paginate(10);
    }

    public function scopeSort($query)
    {
        $query->latest('id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Admin');
    }
}
