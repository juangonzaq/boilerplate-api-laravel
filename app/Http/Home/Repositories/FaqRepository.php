<?php
namespace App\Http\Home\Repositories;

use App\Http\Home\Contracts\IFaq;
use App\Http\Common\Repositories\CommonRepository;

class FaqRepository extends CommonRepository implements IFaq
{
    protected $faqEntity;
    protected $model;

    public function __construct($faqEntity)
    {
        $this->model = $faqEntity;
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