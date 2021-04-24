<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuaranteeRequest extends FormRequest
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
            'investment' => 'required|exists:investments,id',
            'type' => 'required|numeric|in:0,1,2',
            'zip' => 'required|digits:10',
            'address' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'investment.required' => 'لطفا سرمایه‌گذاری مدنظر خود را انتخاب کنید',
            'investment.exists' => 'سرمایه‌گذاری انتخابی در سیستم یافت نشد',
            'type.required' => 'لطفا نوع ضمانت درخواستی رو انتخاب کنید',
            'type.numeric' => 'لطفا نوع ضمانت درخواستی را انتخاب کنید',
            'type.in' => 'نوع ضمانت درخواستی معتبر نیست',
            'zip.required' => 'لطفا کد پستی خود را وارد کنید',
            'zip.digits' => 'کد پستی وارد شده معتبر نیست',
            'address.required' => 'لطفا آدرس کامل پستی خود را بنویسید',
            'address.string' => 'آدرس پستی وارد شده، دارای کاراکتر غیرمجاز است'
        ];
    }
}
