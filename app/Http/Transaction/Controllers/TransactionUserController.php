<?php
namespace App\Http\Transaction\Controllers;

use App\Http\Common\Responses\ResponseBase;
use App\Http\Transaction\Contracts\{ITransaction, ITransactionUser};
use App\Http\Transaction\Requests\TransactionRequest;


class TransactionUserController extends ResponseBase
{
    protected $ITransaction;
    protected $ITransactionUser;
    private $status;

    public function __construct(
        ITransaction $ITransaction,
        ITransactionUser $ITransactionUser)
    {
        $this->ITransaction = $ITransaction;
        $this->ITransactionUser = $ITransactionUser;
    }

    public function store(TransactionRequest $request)
    {
        $transaction = $this->ITransaction->store($request->all());
        return $this->sendResponse($transaction, 'Transaction created successfully.');
    }
}