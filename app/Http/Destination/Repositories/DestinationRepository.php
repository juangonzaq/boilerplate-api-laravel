<?php
namespace App\Http\Destination\Repositories;

use App\Http\Destination\Contracts\IDestination;
use App\Http\Common\Repositories\CommonRepository;

class DestinationRepository extends CommonRepository implements IDestination
{
    protected $destinationEntity;
    protected $model;

    public function __construct($destinationEntity)
    {
        $this->model = $destinationEntity;
    }

    public function index()
    {
        return $this->model->get();
    }

    public function show($id){
        $this->model->get();
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

}