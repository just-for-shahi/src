<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBankAccountRequest extends FormRequest
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
            'iban' => 'required|digits:24|unique:bank_accounts,iban',
            'card' => 'nullable|digits_between:16,20', //|unique:bank_accounts,card
            'account' => 'nullable|digits_between:8,32',
            'photo' => 'required|image'
        ];
    }

    public function messages()
    {
        return [
            'iban.required' => 'شماره شبا خود را بنویسید',
            'iban.digits' => 'شما شبا 24 حرف/عدد باید باشد',
            'iban.unique' => 'شماره شبا در سیستم ثبت شده است',
            'card.digits_between' => 'شماره کارت حداکثر 16 رقم است',
            'card.unique' => 'شماره کارت در سیستم ثبت شده است',
            'account.string' => 'شماره حساب دارای کاراکتر غیرمجاز است',
            'account.digits_between' => 'شماره حساب حداکثر میتواند 32 حرف/عدد باشد',
            'photo.required' => 'تصویر کارت بانکی الزامی است',
            'photo.image' => 'تصویر کارت بانکی بایستی یک فایل تصویر باشد'
        ];
    }
}
