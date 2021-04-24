<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLectureRequest extends FormRequest
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
            'parent' => 'nullable|numeric',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'file' => 'required|file',
            'plus' => 'required|numeric'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'parent.numeric' => 'لطفا درخواست خود را بررسی کنید',
            'title.required' => 'عنوان سرفصل را وارد کنید',
            'title.string' => 'لطفا برای عنوان از کاراکترهای مجاز استفاده کنید',
            'description.string' => 'لطفا درخواست خود را بررسی کنید',
            'file.required' => 'لطفا درخواست خود را بررسی کنید',
            'file.file' => 'لطفا درخواست خود را بررسی کنید',
            'plus.required' => 'لطفا درخواست خود را بررسی کنید',
            'plus.numeric' => 'لطفا درخواست خود را بررسی کنید',
        ];
    }
}
