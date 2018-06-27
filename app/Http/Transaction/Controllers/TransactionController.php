<?php
namespace App\Http\Transaction\Controllers;

use App\Http\Common\Responses\ResponseBase;
use App\Http\Transaction\Contracts\ITransaction;
use App\Http\Transaction\Requests\TransactionRequest;

class TransactionController extends ResponseBase
{
    protected $ITransaction;
    private $status;

    public function __construct(ITransaction $ITransaction)
    {
        $this->ITransaction = $ITransaction;
    }

    public function index()
    {
        $transactions = $this->ITransaction->all();
        return $this->sendResponse($transactions, 'Transactions retrieved successfully.');
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
        $this
            ->updateTransaction($id, $request->all())
            ->addDeletedDestinations($id, $request['delete_destination'])
            ->addUsers();

        return $this->sendResponse($this->status, 'Transaction updated successfully.');
    }
    private function updateTransaction($code, $data){
        $this->status = $this->ITransaction->updateBy('code', $code, $data);
        return $this;
    }
    private function addDeletedDestinations($code, $destinations){

        if(is_array($destinations)){
            $insert = [];
            foreach($destinations as $value){
                $insert[] = [
                    'transaction_code' => $code,
                    'destination_id' => $value
                ];
            }

            if(count($insert) > 0){
                $this->status = \DB::table('transaction_destinations')->insert($insert);
            }
        }
        return $this;
    }
    private function addUsers(){
        $this->status = true;
        return $this;
    }

    public function destroy($code)
    {
        $transaction = $this->ITransaction->destroy($code);
        return $this->sendResponse($transaction, 'Transaction deleted successfully.');
    }

    public function search()
    {
        $transactions = $this->ITransaction->findAllBy(request()->query());
        return $this->sendResponse($transactions, 'Transaction list successfully.');
    }

}