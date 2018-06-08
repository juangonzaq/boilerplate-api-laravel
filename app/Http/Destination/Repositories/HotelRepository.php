<?php
namespace App\Http\Destination\Repositories;

use App\Http\Destination\Contracts\IHotel;
use App\Http\Common\Repositories\CommonRepository;

class HotelRepository extends CommonRepository implements IHotel
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