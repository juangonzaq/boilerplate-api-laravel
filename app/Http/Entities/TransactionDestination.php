<?php
namespace App\Http\Entities;

use Illuminate\Database\Eloquent\Model;

class TransactionDestination extends Model
{
    public $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];
    public function destination()
    {
        return $this->hasOne('App\Http\Entities\Destination','id','destination_id');
    }
}