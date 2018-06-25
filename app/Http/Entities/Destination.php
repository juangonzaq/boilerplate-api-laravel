<?php

namespace App\Http\Entities;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    public $fillable = ['name', 'slug', 'status', 'featured'];
    public $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function setNameAttribute($value){
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }
}