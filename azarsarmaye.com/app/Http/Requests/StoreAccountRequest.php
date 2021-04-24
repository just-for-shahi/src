<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
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
            'name' => 'required|string',
            'color' => 'required|in:0,1,2,3,4,5',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'لطفا نام حساب را وارد کنید',
            'name.string' => 'لطفا از کاراکترهای مجاز برای نام حساب استفاده کنید',
            'color.required' => 'لطفا رنگ حساب را انتخاب کنید',
            'color.in' => 'لطفا رنگ مجاز برای حساب پیدا کنید',
        ];
    }
}
