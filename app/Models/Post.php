<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App;

class Post extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['title', 'description', 'meta_title', 'meta_description'];
    protected $fillable = ['slug', 'image', 'status'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->defaultLocale = App::getLocale();
    }

    public function getPostsList()
    {
        return $this->sort()->translatedIn()->paginate(10);
    }

    public function getPosts()
    {
        return $this->sort()->translatedIn()->get();
    }

    public function scopeSort($query)
    {
        $query->latest('id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Admin');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
