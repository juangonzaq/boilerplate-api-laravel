<?php
namespace App\Http\Home\Repositories;

use App\Http\Home\Contracts\ITestimony;
use App\Http\Common\Repositories\CommonRepository;

class TestimonyRepository extends CommonRepository implements ITestimony
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