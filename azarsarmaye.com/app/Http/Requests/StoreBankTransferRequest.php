<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBankTransferRequest extends FormRequest
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
            'bank-account' => 'required|exists:bank_accounts,id',
            'amount' => 'required|numeric',
            'receipt' => 'required|file'
        ];
    }

    public function messages()
    {
        return [
            'bank-account.required' => 'حساب مالی مدنظر خود را انتخاب کنید',
            'bank-account.exists' => 'حساب مالی انتخاب شده در سیستم یافت نشد',
            'bank-amount.required' => 'مبلغ انتقالی خود را وارد کنید',
            'amount.numeric' => 'مبلغ وارد شده باید به عدد باشد',
            'receipt.required' => 'ارسال رسید الزامی است',
            'receipt.file' => 'رسید شما معتبر نیست',
        ];
    }
}
