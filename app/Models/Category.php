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

    public function getCategoriesList()
    {
        return $this->sort2()->paginate(10);
    }

    public function getCategories()
    {
        return $this->join('category_translations as t', 'categories.id', '=', 't.category_id')
                    ->select('categories.*', 't.locale', 't.title', 't.meta_title', 't.meta_description')
                    ->where('t.locale', '=', $this->defaultLocale)
                    ->admitted()
                    ->sort()
                    ->get();
    }

    public function storeCategory($request)
    {
        $data = [
            'slug' => $request->slug,
            'status' => $request->status,
        ];

        foreach (config('translatable.locales') as $lang) {
            $data[$lang]['title'] = $request->input('title-' . $lang);
            $data[$lang]['meta_title'] = $request->input('meta-title-' . $lang);
            $data[$lang]['meta_description'] = $request->input('meta-description-' . $lang);
        }

        $post = $this->create($data);
    }

    public function getCategoryById($id)
    {
        return $this->findOrfail($id);
    }

    public function updateCategory($request, $id)
    {
        $post = $this->findOrFail($id);

        $post->slug = $request->slug;
        $post->status = $request->status;

        foreach (config('translatable.locales') as $lang) {
            $post->translate($lang)->title = $request->input('title-' . $lang);
            $post->translate($lang)->meta_title = $request->input('meta-title-' . $lang);
            $post->translate($lang)->meta_description = $request->input('meta-description-' . $lang);
        }

        $post->touch();
        $post->save();
    }

    public function destroyCategory($id)
    {
        $post = $this->findOrFail($id);
        $post->delete();
    }

    public function scopeSort($query)
    {
        $query->orderBy('t.title', 'asc');
    }

    public function scopeSort2($query)
    {
        $query->latest('id');
    }

    public function scopeAdmitted($query)
    {
        $query->where('status', true);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = strtolower($value);
    }

    public function getCreatedAtattribute($value)
    {
        return date('j, m, Y | g:i:s a', strtotime($value));
    }

    public function getUpdatedAtattribute($value)
    {
        return date('j, m, Y | g:i:s a', strtotime($value));
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
