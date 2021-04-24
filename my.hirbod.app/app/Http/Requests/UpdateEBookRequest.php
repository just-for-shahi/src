<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEBookRequest extends FormRequest
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
            'title' => 'required|string',
            'cover' => 'nullable|image',
            'introduction' => 'nullable|string',
            'year' => 'nullable|digits:4',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'لطفا عنوان کتاب را وارد کنید',
            'title.string' => 'لطفا عنوان کتاب را با استفاده از کاراکترهای مجاز بنویسید',
            'cover.required' => 'لطفا جلد روی کتاب را انتخاب کنید',
            'cover.image' => 'لطفا جلد روی کتاب را از تصاویر انتخاب کنید',
            'introduction.required' => 'لطفا توضیحات کتاب را وارد کنید',
            'introduction.string' => 'لطفا توضیحات کتاب را با کاراکترهای مجاز بنویسید',
            'year.required' => 'لطفا سال انتشار کتاب را وارد کنید',
            'year.digits' => 'لطفا سال انتشار کتاب را بصورت چهاررقمی و عدد انگلیسی وارد کنید',
            'publisher.required' => 'لطفا نام انتشارات کتاب را وارد کنید',
            'publisher.string' => 'لطفا برای نام انتشارات از کاراکترهای مجاز استفاده کنید',
        ];
    }
}
