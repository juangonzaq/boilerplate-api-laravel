<?php
namespace App\Http\Entities;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    public $fillable = ['min_travelers', 'max_travelers', 'price_per_person', 'price_limit_flight',
        'price_insurance', 'price_delete_destination', 'qty_max_delete_destination'];
    public $hidden = ['id', 'deleted_at', 'created_at', 'updated_at'];
}