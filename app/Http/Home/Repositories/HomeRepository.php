<?php
namespace App\Http\Home\Repositories;

use App\Http\Home\Contracts\IHome;
use App\Http\Common\Repositories\CommonRepository;

class HomeRepository extends CommonRepository implements IHome
{
    protected $hotelEntity;
    protected $model;

    public function __construct($hotelEntity)
    {
        $this->model = $hotelEntity;
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