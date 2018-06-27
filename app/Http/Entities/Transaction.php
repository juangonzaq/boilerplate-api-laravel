<?php

namespace App\Http\Entities;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['code', 'qty_days', 'qty_travelers', 'date_start', 'date_end', 'flight_schedule_start', 'flight_schedule_back',
        'season_type', 'qty_unwanted_destinations', 'subject', 'value_coupon', 'type_passage', 'destination_origin_id', 'status'];

    public function setDestinationOriginIdAttribute($value){
        $this->attributes['destination_origin_id'] = $value;
        $this->attributes['code'] = uniqid().time();
    }

    public function details()
    {
        return $this->hasMany('App\Http\Entities\TransactionDetail','transaction_id','id');
    }

    public function destinations()
    {
        return $this->hasMany('App\Http\Entities\TransactionDestination','transaction_code','code');
    }
}