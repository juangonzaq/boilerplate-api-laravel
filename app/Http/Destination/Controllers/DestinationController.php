<?php
namespace App\Http\Destination\Controllers;

use App\Http\Common\Responses\ResponseBase;
use App\Http\Destination\Contracts\IDestination;
use App\Http\Destination\Requests\DestinationRequest;

class DestinationController extends ResponseBase
{
    protected $IDestination;
    public function __construct(IDestination $IDestination)
    {
        $this->IDestination = $IDestination;
        $this->middleware('guest');
    }

    public function index()
    {
        $destinations = $this->IDestination->index();
        return $this->sendResponse($destinations, 'Destinations retrieved successfully.');
    }

    public function show($id)
    {
        $destinations = $this->IDestination->findBy('id', $id);
        return $this->sendResponse($destinations, 'Destination retrieved successfully.');
    }

    public function store(DestinationRequest $request)
    {
        $destination = $this->IDestination->store($request->all());
        return $this->sendResponse($destination, 'Destination created successfully.');
    }

    public function update($id, DestinationRequest $request)
    {
        $destination = $this->IDestination->update($id, $request->all());
        return $this->sendResponse($destination, 'Destination updated successfully.');
    }

    public function destroy($id)
    {
        $destination = $this->IDestination->destroy($id);
        return $this->sendResponse($destination, 'Destination deleted successfully.');
    }

}
