<?php

namespace App\Http\Transaction\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class TransactionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        $rules = [];
        switch($request->method()){
            case 'POST':
                $rules =
                    [
                        'destination_origin_id' => 'required',
                        'qty_travelers' =>  'required|max:100|min:1',
                        'qty_days' =>  'required|max:100|min:1'
                    ];
                break;
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'destination_origin_id.required' => 'Debes seleccionar un destino de origen',
            'qty_travelers.required'   => 'Debes seleccionar la cantidad de viajeros',
            'qty_days.required'   => 'Debes seleccionar los días de viaje'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        header('HTTP/1.1 400', true, 400);
        exit(json_encode([
            'success' => false,
            'data' => $validator->errors()
        ], true));
    }
}
