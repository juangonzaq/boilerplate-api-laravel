<?php
namespace App\Http\Destination\Controllers;

use App\Http\Common\Responses\ResponseBase;
use App\Http\Destination\Contracts\IHotel;
use App\Http\Destination\Requests\HotelRequest;

class HotelController extends ResponseBase
{
    protected $IHotel;
    protected $ICommonRepository;

    public function __construct(IHotel $IHotel)
    {
        $this->IHotel = $IHotel;
        $this->middleware('guest');
    }

    public function index()
    {
        $services = $this->IHotel->all();
        return $this->sendResponse($services, 'Hotels retrieved successfully.');
    }

    public function show($id)
    {
        $services = $this->IHotel->findBy('id', $id);
        return $this->sendResponse($services, 'Hotel retrieved successfully.');
    }

    public function store(HotelRequest $request)
    {
        $service = $this->IHotel->store($request->all());
        return $this->sendResponse($service, 'Hotel created successfully.');
    }

    public function update($id, HotelRequest $request)
    {
        $service = $this->IHotel->update($id, $request->all());
        return $this->sendResponse($service, 'Hotel updated successfully.');
    }

    public function destroy($id)
    {
        $service = $this->IHotel->destroy($id);
        return $this->sendResponse($service, 'Hotel deleted successfully.');
    }

    public function search(){
        $services = $this->IHotel->findAllBy(request()->query());
        return $this->sendResponse($services, 'Hotel list successfully.');
    }

}
