<?php
namespace App\Http\Transaction\Repositories;

use App\Http\Common\Repositories\CommonRepository;
use App\Http\Transaction\Contracts\ITransactionDestination;

class TransactionDestinationRepository extends CommonRepository implements ITransactionDestination
{
    protected $model;

    public function __construct($txEntity)
    {
        $this->model = $txEntity;
    }

    public function updateDeletedDestinations($code, $destinations)
    {
        try{

            \DB::transaction(function () use($code, $destinations){

                if(is_array($destinations)){
                    $insert = [];
                    foreach($destinations as $value){
                        $insert[] = [
                            'transaction_code' => $code,
                            'destination_id' => $value
                        ];
                    }

                    if(count($insert) > 0){
                        $this->model->where('transaction_code', $code)->delete();
                        $this->model->insert($insert);
                    }
                }
                return $this;
            }, 1);

        } catch (\Exception $exception) {
            throw new \HttpResponseException(response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 422));
        }
    }
}