<?php
namespace App\Http\Transaction\Controllers;

use App\Http\Common\Responses\ResponseBase;
use App\Http\Transaction\Contracts\{ITransaction, ITransactionDestination};
use App\Http\Transaction\Requests\TransactionRequest;
//Strategy
use App\Http\Transaction\Controllers\Strategy\SaveOrUpdateTransactionStrategy;

class TransactionController extends ResponseBase
{
    protected $ITransaction;
    protected $ITransactionDestination;
    private $status;

    public function __construct(
        ITransaction $ITransaction,
        ITransactionDestination $ITransactionDestination)
    {
        $this->ITransaction = $ITransaction;
        $this->ITransactionDestination = $ITransactionDestination;
    }

    public function index()
    {
        $transactions = $this->ITransaction->all();
        return $this->sendResponse($transactions);
    }

    public function show($id)
    {
        $transactions = $this->ITransaction->getTransactionWithAllDetailsByCode($id);
        return $this->sendResponse($transactions, 'Transaction retrieved successfully.');
    }

    public function store(TransactionRequest $request)
    {
        $transaction = $this->ITransaction->store($request->all());
        return $this->sendResponse($transaction, 'Transaction created successfully.');
    }

    public function update($id, TransactionRequest $request)
    {
        if(count($request['delete_destination']) == 0){
            $this->status = $this->ITransaction->updateBy('code', $id, $request->all());
        } else {
            $this->status = $this->ITransactionDestination->updateDeletedDestinations($id, $request['delete_destination']);
        }
        return $this->sendResponse([], 'Transaction updated successfully.', $this->status);
    }

    public function destroy($code)
    {
        $transaction = $this->ITransaction->destroy($code);
        return $this->sendResponse($transaction, 'Transaction deleted successfully.');
    }
}