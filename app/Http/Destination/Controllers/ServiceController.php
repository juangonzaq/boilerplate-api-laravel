<?php
namespace App\Http\Destination\Controllers;

use App\Http\Common\Responses\ResponseBase;
use App\Http\Destination\Contracts\IService;
use App\Http\Destination\Requests\ServiceRequest;

class ServiceController extends ResponseBase
{
    protected $IService;
    protected $ICommonRepository;

    public function __construct(IService $IService)
    {
        $this->IService = $IService;
        $this->middleware('guest');
    }

    public function index()
    {
        $services = $this->IService->all();
        return $this->sendResponse($services, 'Services retrieved successfully.');
    }

    public function show($id)
    {
        $services = $this->IService->findBy('id', $id);
        return $this->sendResponse($services, 'Service retrieved successfully.');
    }

    public function store(ServiceRequest $request)
    {
        $service = $this->IService->store($request->all());
        return $this->sendResponse($service, 'Service created successfully.');
    }

    public function update($id, ServiceRequest $request)
    {
        $service = $this->IService->update($id, $request->all());
        return $this->sendResponse($service, 'Service updated successfully.');
    }

    public function destroy($id)
    {
        $service = $this->IService->destroy($id);
        return $this->sendResponse($service, 'Service deleted successfully.');
    }

    public function search(){
        $services = $this->IService->findAllBy(request()->query());
        return $this->sendResponse($services, 'Service list successfully.');
    }

}
