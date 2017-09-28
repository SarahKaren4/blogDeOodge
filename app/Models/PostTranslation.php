<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'description', 'meta_title', 'meta_description'];
}
