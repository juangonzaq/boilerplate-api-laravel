<?php
namespace App\Http\Destination\Repositories;

use App\Http\Destination\Contracts\IService;
use App\Http\Common\Repositories\CommonRepository;

class ServiceRepository extends CommonRepository implements IService
{
    protected $serviceEntity;
    protected $model;

    public function __construct($serviceEntity)
    {
        $this->model = $serviceEntity;
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