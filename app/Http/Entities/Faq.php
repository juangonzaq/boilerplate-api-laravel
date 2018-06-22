<?php

namespace App\Http\Entities;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    public $fillable = ['name', 'slug', 'status', 'featured', 'image'];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }
}