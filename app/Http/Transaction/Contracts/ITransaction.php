<?php
namespace App\Http\Transaction\Contracts;
use App\Http\Common\Contracts\ICommonRepository;

interface ITransaction extends ICommonRepository
{
    public function index();

    public function show($id);

    public function store($data);

    public function destroy($id);

    public function getTransactionWithAllDetailsByCode($code);
}