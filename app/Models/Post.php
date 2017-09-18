<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App;

class Post extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['title', 'description', 'meta_title', 'meta_description'];
    protected $fillable = ['slug', 'image', 'status', 'created_at', 'updated_at', 'user_id'];
    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->defaultLocale = App::getLocale();
    }

    public function getPostsList()
    {
        return $this->sort()->translated()->paginate(10);
    }

    public function getPosts()
    {
        return $this->sort()->translated()->get();
    }

    public function storePost($request)
    {
        $data = [
            'slug' => $request->slug,
            'created_at' => $request->created_at,
            'updated_at' => $request->created_at,
            'status' => $request->status,
            'user_id' => $request->user()->id,
        ];

        foreach (config('translatable.locales') as $lang) {
            $data[$lang]['title'] = $request->input('title-' . $lang);
            $data[$lang]['description'] = $request->input('description-' . $lang);
            $data[$lang]['meta_title'] = $request->input('meta-title-' . $lang);
            $data[$lang]['meta_description'] = $request->input('meta-description-' . $lang);
        }

        $post = $this->create($data);
        $post->categories()->attach($request->categories);
    }

    public function scopeSort($query)
    {
        $query->latest('id');
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = date('Y-m-d H:i:s', strtotime($value));
    }

    public function setUpdatedAtAttribute($value)
    {
        $this->attributes['updated_at'] = date('Y-m-d H:i:s', strtotime($value));
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
