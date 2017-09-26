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
                    ->groupBy('categories.id')
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

        $category = $this->create($data);
    }

    public function getCategoryById($id)
    {
        return $this->findOrfail($id);
    }

    public function getCategoryBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    public function getPostsList($category)
    {
        return $category->posts()->paginate(10);
    }

    public function updateCategory($request, $id)
    {
        $category = $this->findOrFail($id);

        $category->slug = $request->slug;
        $category->status = $request->status;

        foreach (config('translatable.locales') as $lang) {
            $category->translate($lang)->title = $request->input('title-' . $lang);
            $category->translate($lang)->meta_title = $request->input('meta-title-' . $lang);
            $category->translate($lang)->meta_description = $request->input('meta-description-' . $lang);
        }

        $category->touch();
        $category->save();
    }

    public function destroyCategory($id)
    {
        $category = $this->findOrFail($id);

        $importantRelations = $category->posts()->count();

        if (!$importantRelations) {
            $category->delete();
        }
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
        return $this->belongsToMany('App\Models\Post')->orderBy('published_at', 'desc');
    }

    public function categoryTranslations()
    {
        return $this->hasMany('App\Models\CategoryTranslation');
    }
}
