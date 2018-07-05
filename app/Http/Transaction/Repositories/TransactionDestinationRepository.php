<?php
namespace App\Http\Transaction\Repositories;

use App\Http\Common\Repositories\CommonRepository;
use App\Http\Transaction\Contracts\ITransactionDestination;
use Illuminate\Http\Exceptions\HttpResponseException;

class TransactionDestinationRepository extends CommonRepository implements ITransactionDestination
{
    protected $model;
    private $status = false;

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
                        $this->status = $this->model->insert($insert);
                    }
                }
            }, 1);
            return $this->status;
        } catch (\Exception $exception) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 422));
        }
    }
}