<?php
namespace App\Http\Transaction\Repositories;

use App\Http\Transaction\Contracts\ITransaction;
use App\Http\Common\Repositories\CommonRepository;

class TransactionRepository extends CommonRepository implements ITransaction
{
    protected $model;

    public function __construct($txEntity)
    {
        $this->model = $txEntity;
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

    public function getTransactionWithAllDetailsByCode($code)
    {
        return $this->model->with(['details', 'details.user', 'destinations', 'destinations.destination'])
            ->where('code', $code)
            ->get();
    }
}