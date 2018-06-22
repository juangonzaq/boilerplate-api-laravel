<?php
namespace App\Http\Home\Controllers;

use App\Http\Common\Responses\ResponseBase;
use App\Http\Home\Contracts\ITestimony;
use App\Http\Home\Requests\TestimonyRequest;

class TestimonyController extends ResponseBase
{
    protected $IDestination;
    protected $ICommonRepository;

    public function __construct(ITestimony $IDestination)
    {
        $this->IDestination = $IDestination;
        $this->middleware('guest');
    }

    public function index()
    {
        $destinations = $this->IDestination->all();
        return $this->sendResponse($destinations, 'Destinations retrieved successfully.');
    }

    public function show($id)
    {
        $destinations = $this->IDestination->findBy('id', $id);
        return $this->sendResponse($destinations, 'Destination retrieved successfully.');
    }

    public function store(TestimonyRequest $request)
    {
        $destination = $this->IDestination->store($request->all());
        return $this->sendResponse($destination, 'Destination created successfully.');
    }

    public function update($id, TestimonyRequest $request)
    {
        $destination = $this->IDestination->update($id, $request->all());
        return $this->sendResponse($destination, 'Destination updated successfully.');
    }

    public function destroy($id)
    {
        $destination = $this->IDestination->destroy($id);
        return $this->sendResponse($destination, 'Destination deleted successfully.');
    }

    public function search(){
        $destinations = $this->IDestination->findAllBy(request()->query());
        return $this->sendResponse($destinations, 'Destination list successfully.');
    }

}