<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'priority' => 'required|in:0,1,2',
            'message' => 'required|string',
            'department' => 'required|in:0,1,2,3'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'لطفا عنوان درخواست خود را بنویسید',
            'title.string' => 'عنوان درخواست حاوی کاراکتر غیرمجاز است',
            'title.max' => 'عنوان درخواست حداکثر 255 حرف میتواند باشد',
            'priority.required' => 'اولویت درخواست خود را انتخاب کنید',
            'priority.in' => 'اولویت درخواست انتخابی معتبر نیست',
            'message.required' => 'متن درخواست خود را بنویسید',
            'message.string' => 'متن درخواست شما دارای کاراکتر غیرمجاز است',
            'department.required' => 'لطفا دپارتمان مربوط به درخواست خود را بنویسید',
            'department.in' => 'دپارتمان انتخاب معتبر نیست',
        ];
    }
}
