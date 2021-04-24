<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWalletRequest extends FormRequest
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
            'address' => 'required|string',
            'currency' => 'required|in:0'
        ];
    }

    public function messages()
    {
        return [
            'address.required' => 'لطفا آدرس کیفپول رمزارز خود را وارد کنید',
            'address.string' => 'لطفا آدرس صحیح کیف پول رمزارز خود را وارد کنید',
            'currency.required' => 'لطفا نوع رمزارز را انتخاب کنید',
            'currency.in' => 'لطفا نوع رمزارز را از لیست معتبر آذرسرمایه انتخاب کنید'
        ];
    }
}
