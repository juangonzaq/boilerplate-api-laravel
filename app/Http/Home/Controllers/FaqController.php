<?php
namespace App\Http\Home\Controllers;

use App\Http\Common\Responses\ResponseBase;
use App\Http\Home\Contracts\IFaq;
use App\Http\Home\Requests\FaqRequest;

class FaqController extends ResponseBase
{
    protected $IFaq;
    protected $ICommonRepository;

    public function __construct(IFaq $IFaq)
    {
        $this->IFaq = $IFaq;
        $this->middleware('guest');
    }

    public function index()
    {
        $services = $this->IFaq->all();
        return $this->sendResponse($services, 'Faqs retrieved successfully.');
    }

    public function show($id)
    {
        $services = $this->IFaq->findBy('id', $id);
        return $this->sendResponse($services, 'Faq retrieved successfully.');
    }

    public function store(FaqRequest $request)
    {
        $service = $this->IFaq->store($request->all());
        return $this->sendResponse($service, 'Faq created successfully.');
    }

    public function update($id, FaqRequest $request)
    {
        $service = $this->IFaq->update($id, $request->all());
        return $this->sendResponse($service, 'Faq updated successfully.');
    }

    public function destroy($id)
    {
        $service = $this->IFaq->destroy($id);
        return $this->sendResponse($service, 'Faq deleted successfully.');
    }

    public function search(){
        $services = $this->IFaq->findAllBy(request()->query());
        return $this->sendResponse($services, 'Faq list successfully.');
    }

}
