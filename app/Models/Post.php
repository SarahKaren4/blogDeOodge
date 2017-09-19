<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App;
use Purifier;
use Image;

class Post extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['title', 'description', 'meta_title', 'meta_description'];
    protected $fillable = ['slug', 'image', 'status', 'published_at', 'user_id'];

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
            'published_at' => $request->published_at,
            'status' => $request->status,
            'user_id' => $request->user()->id,
        ];

        foreach (config('translatable.locales') as $lang) {
            $data[$lang]['title'] = $request->input('title-' . $lang);
            $data[$lang]['description'] = $request->input('description-' . $lang);
            $data[$lang]['meta_title'] = $request->input('meta-title-' . $lang);
            $data[$lang]['meta_description'] = $request->input('meta-description-' . $lang);
        }

        if ($request->hasFile('image')) {
            $fileName = $this->saveFile($request->file('image'));
            $data['image'] = $fileName;
        }

        $post = $this->create($data);
        $post->categories()->attach($request->categories);
    }

    public function getPostById($id)
    {
        return $this->findOrfail($id);
    }

    public function updatePost($request, $id)
    {
        $post = $this->findOrFail($id);

        $post->slug = $request->slug;
        $post->published_at = $request->published_at;
        $post->status = $request->status;

        if ($request->hasFile('image')) {
            $this->deleteFile($post->image);
            $fileName = $this->saveFile($request->file('image'));
            $post->image = $fileName;
        }

        foreach (config('translatable.locales') as $lang) {
            $post->translate($lang)->title = $request->input('title-' . $lang);
            $post->translate($lang)->description = $request->input('description-' . $lang);
            $post->translate($lang)->meta_title = $request->input('meta-title-' . $lang);
            $post->translate($lang)->meta_description = $request->input('meta-description-' . $lang);
        }

        $post->touch();
        $post->save();
        $post->categories()->sync($request->categories);
    }

    public function scopeSort($query)
    {
        $query->latest('id');
    }

    public function getPublishedAtattribute($value)
    {
        return date('j, m, Y | g:i:s a', strtotime($value));
    }

    public function getCreatedAtattribute($value)
    {
        return date('j, m, Y | g:i:s a', strtotime($value));
    }

    public function getUpdatedAtattribute($value)
    {
        return date('j, m, Y | g:i:s a', strtotime($value));
    }

    public function setPublishedAtattribute($value)
    {
        $this->attributes['published_at'] = date('Y-m-d H:i:s', strtotime($this->formatDate($value)));
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = strtolower($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attribures['description'] = Purifier::clean($value);
    }

    private function formatDate($value)
    {
        return preg_replace(['/[\|]/', '/,\s/'], ['', '.'], $value);
    }

    private function saveFile($file)
    {
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $location = public_path('images/posts/' . $fileName);
        $locationSm = public_path('images/posts/small/' . $fileName);

        Image::make($file)->save($location);
        Image::make($file)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($locationSm);

        return $fileName;
    }

    private function deleteFile($file)
    {
        unlink(public_path('images/posts/' . $file));
        unlink(public_path('images/posts/small/' . $file));
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
