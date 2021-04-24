<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEBookRequest extends FormRequest
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
            'file' => 'required|file',
            'title' => 'required|string',
            'cover' => 'required|image',
            'introduction' => 'required|string',
            'year' => 'required|digits:4',
            'isbn' => 'required|unique:ebooks,isbn|digits:13',
            'level' => 'required|numeric',
            'publisher' => 'required|string',
            'category' => 'required',
            'tags' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'لطفا فایل کتاب مدنظر را انتخاب کنید',
            'file.file' => 'لطفا فایل خود را از فایل‌های استاندارد و مجاز انتخاب کنید',
            'title.required' => 'لطفا عنوان کتاب را وارد کنید',
            'title.string' => 'لطفا عنوان کتاب را با استفاده از کاراکترهای مجاز بنویسید',
            'cover.required' => 'لطفا جلد روی کتاب را انتخاب کنید',
            'cover.image' => 'لطفا جلد روی کتاب را از تصاویر انتخاب کنید',
            'introduction.required' => 'لطفا توضیحات کتاب را وارد کنید',
            'introduction.string' => 'لطفا توضیحات کتاب را با کاراکترهای مجاز بنویسید',
            'year.required' => 'لطفا سال انتشار کتاب را وارد کنید',
            'year.digits' => 'لطفا سال انتشار کتاب را بصورت چهاررقمی و عدد انگلیسی وارد کنید',
            'isbn.required' => 'لطفا شابک کتاب را وارد کنید',
            'isbn.unique' => 'شابک وارد شده قبلا در سیستم وارد شده است',
            'isbn.digits' => 'لطفا شابک کتاب را بصورت عددی و ۱۳ رقمی وارد کنید',
            'level.required' => 'لطفا سطح کتاب را انتخاب کنید',
            'level.numeric' => 'لطفا سطح کتاب را به درستی انتخاب کنید',
            'publisher.required' => 'لطفا نام انتشارات کتاب را وارد کنید',
            'publisher.string' => 'لطفا برای نام انتشارات از کاراکترهای مجاز استفاده کنید',
            'category.required' => 'لطفا دسته بندی کتاب را انتخاب کنید',
            'tags.required' => 'لطفا برچسب‌های کتاب را وارد کنید',
            'tags.string' => 'لطفا برای برچسب‌های کتاب از کاراکترهای مجاز استفاده کنید',
        ];
    }
}
