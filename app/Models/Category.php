<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class Category extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['title', 'meta_title', 'meta_description'];
    protected $fillable = ['slug', 'status'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->defaultLocale = App::getLocale();
    }

    public function getCategories()
    {
        return $this->join('category_translations as t', 'categories.id', '=', 't.category_id')
                    ->select('categories.*', 't.locale', 't.title', 't.meta_title', 't.meta_description')
                    ->where('t.locale', '=', $this->defaultLocale)
                    ->sort()
                    ->get();
    }

    public function scopeSort($query)
    {
        $query->orderBy('t.title', 'asc');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function categoryTranslations()
    {
        return $this->hasMany('App\Models\CategoryTranslation');
    }
}
