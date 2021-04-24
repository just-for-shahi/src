<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvestmentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' =>  'required|numeric|min:1000',
            'cryptocurrency' => 'required|numeric|in:0,1,2,3',
            'period' => 'required|numeric|in:90,180,365'
        ];
    }
}
