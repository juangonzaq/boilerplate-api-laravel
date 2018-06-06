<?php
namespace App\Http\Destination\Repositories;

use App\Http\Destination\Contracts\IDestination;

class DestinationRepository implements IDestination
{

    protected $destinationEntity;

    public function __construct($destinationEntity)
    {
        $this->destinationEntity = $destinationEntity;
    }

    public function index()
    {
        return $this->destinationEntity->get();
    }

    public function findBy($column, $value)
    {
        return $this->destinationEntity->where($column, $value)->get();
    }

    public function show($id){
        $this->destinationEntity->get();
    }

    public function store($data)
    {
        return $this->destinationEntity->create($data);
    }

    public function update()
    {
    }

    public function destroy($id)
    {
    }
}