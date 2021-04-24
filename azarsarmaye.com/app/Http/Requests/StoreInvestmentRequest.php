<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvestmentRequest extends FormRequest
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
            'account' => 'required',
            'amount' => 'required|integer|between:1000,50000000'
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'مشتری گرامی، لطفا مبلغ سرمایه‌گذاری را وارد کنید',
            'amount.integer' => 'مشتری گرامی، مبلغ وارد شده صحیح نیست',
            'amount.between' => 'مشتری گرامی، حداقل مبلغ سرمایه‌گذاری 1000 تومان و حداکثر 50 میلیون تومان (برای پرداخت آنلاین) است.'
        ];
    }
}
