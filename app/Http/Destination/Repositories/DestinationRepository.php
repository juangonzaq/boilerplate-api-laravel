<?php
namespace App\Http\Destination\Repositories;

use App\Http\Destination\Contracts\IDestination;

class DestinationRepository implements IDestination
{

    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function show($id){
        $this->model->get();
    }
}