<?php

namespace App\Http\Entities;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    public $fillable = ['name', 'slug'];

    public function setSlugAttribute($value){
        $this->attributes['slug'] = str_slug($value);
    }
}