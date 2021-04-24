<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'cover' => 'required|image',
            'description' => 'nullable|string',
            'introduction' => 'nullable',
            'category' => 'required',
            'tags' => 'required|string',
            'price' => 'nullable|numeric',
            'special-price' => 'nullable|numeric'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'لطفا عنوان دوره را وارد کنید',
            'title.string' => 'لطفا تنها از حروف و اعداد برای عنوان دوره استفاده کنید',
            'cover.required' => 'لطفا کاور دوره را انتخاب کنید',
            'cover.image' => 'لطفا کاور دوره را از تصاویر انتخاب کنید',
            'description.string' => 'لطفا برای معرفی دوره تنها از اعداد و حروف مجاز استفاده کنید',
            'category.required' => 'لطفا دسته بندی دوره را انتخاب کنید',
            'tags.required' => 'لطفا برچسب‌های دوره را وارد کنید',
            'tags.string' => 'لطفا برای برچسب‌های دوره از کاراکترهای مجاز استفاده کنید',
            'price.numeric' => 'لطفا قیمت را به صورت عدد انگلیسی وارد کنید',
            'special-price.numeric' => 'لطفا قیمت ویژه را به صورت عدد انگلیسی وارد کنید',        ];
    }
}
