<?php
namespace App\Http\Home\Controllers;

use App\Http\Common\Responses\ResponseBase;
use App\Http\Home\Contracts\IConfiguration;
use App\Http\Destination\Contracts\IDestination;

class ConfigurationController extends ResponseBase
{
    protected $IConfiguration;
    protected $IDestination;

    public function __construct(
        IConfiguration $IConfiguration,
        IDestination $IDestination
    )
    {
        $this->IConfiguration = $IConfiguration;
        $this->IDestination = $IDestination;
        $this->middleware('guest');
    }

    public function index()
    {
        $configurations = $this->IConfiguration->first();
        $destinations = $this->IDestination->all();
        $data = [
            'configuration' => $configurations,
            'destinations' => $destinations
        ];
        return $this->sendResponse($data, 'Configurations retrieved successfully.');
    }

    public function store()
    {
        $destination = $this->IConfiguration->store(request()->all());
        return $this->sendResponse($destination, 'Destination created successfully.');
    }

    public function update($id)
    {
        $destination = $this->IConfiguration->update($id, request()->all());
        return $this->sendResponse($destination, 'Destination updated successfully.');
    }

    public function search(){
        $destinations = $this->IConfiguration->findAllBy(request()->query());
        return $this->sendResponse($destinations, 'Destination list successfully.');
    }

}