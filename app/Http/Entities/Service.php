<?php

namespace App\Http\Entities;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $fillable = ['name', 'slug', 'status'];

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_slug($value);
    }
}