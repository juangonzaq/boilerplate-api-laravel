<?php

namespace App\Http\Entities;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    public $fillable = ['name', 'slug', 'status', 'featured', 'image'];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }
}