<?php
namespace App\Http\Entities;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    public $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function transaction()
    {
        return $this->belongsTo('App\Http\Entities\Transaction');
    }
}