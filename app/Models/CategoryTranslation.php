<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'meta_title', 'meta_description'];

    public function category()
    {
        return $this->blongsTo('App\Models\Category');
    }
}
