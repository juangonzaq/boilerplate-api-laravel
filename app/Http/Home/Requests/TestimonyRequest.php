<?php

namespace App\Http\Home\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class TestimonyRequest extends FormRequest
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
                        'name' => 'required|unique:destinations|max:100'
                    ];
                break;
            case 'PUT':
                $rules =
                    [
                        'name' => 'unique:destinations|max:100'
                    ];
                break;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.unique'   => 'El nombre del destino debe ser único'
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
