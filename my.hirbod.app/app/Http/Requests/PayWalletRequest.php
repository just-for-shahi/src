<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayWalletRequest extends FormRequest
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
            'amount' => 'required|numeric|between:1000,50000000'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'amount.required' => 'لطفا مبلغ مدنظر برای شارژ کیف‌پول خود را وارد کنید',
            'amount.numeric' => 'لطفا مبلغ مدنظر را به صورت عدد انگلیسی وارد کنید',
            'amount.between' => 'حداقل شارژ ۱۰ هزارتومان و حداکثر ۵۰ میلیون تومان است'
        ];
    }
}
