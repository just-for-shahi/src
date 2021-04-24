<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWithdrawRequest extends FormRequest
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
            'account' => 'required|exists:accounts,id',
            'bank-account' => 'required|exists:bank_accounts,id',
            'amount' => 'required|integer|between:25000,50000000'
        ];
    }

    public function messages()
    {
        return [
            'account.required' => 'لطفا حساب مالی خود را انتخاب کنید',
            'account.exists' => 'حساب مالی مدنظر در سیستم یافت نشد',
            'bank-account.required' => 'لطفا حساب بانکی مد نظر را انتخاب کنید',
            'bank-account.exists' => 'حساب بانکی مدنظر در سیستم یافت نشد',
            'amount.required' => 'لطفا مبلغ تسویه را وارد کنید',
            'amount.integer' => 'لطفا مبلغ را به عدد وارد کنید',
            'amount.between' => 'مبلغ برداشت باید بین 25,000 تومان تا 50,000,000 تومان به صورت روزانه است'
        ];
    }
}
