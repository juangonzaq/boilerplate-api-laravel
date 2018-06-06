<?php

namespace App\Http\Destination\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class DestinationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:destinations|max:100'
        ];
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
        exit(json_encode($validator->errors(), true));
    }
}
