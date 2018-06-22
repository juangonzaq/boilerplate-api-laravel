<?php

namespace App\Http\Entities;

use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    public $fillable = ['name', 'slug', 'status', 'featured', 'user_image', 'user_name', 'user_age'];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }
}