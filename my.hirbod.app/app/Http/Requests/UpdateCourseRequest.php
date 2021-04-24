<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
            'description' => 'required|string',
            'cover' => 'nullable|image',
            'price' => 'nullable|numeric',
            'special-price' => 'nullable|numeric',
            'introduction' => 'required'
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
            'cover.image' => 'لطفا کاور دوره را از تصاویر انتخاب کنید',
            'description.string' => 'لطفا برای معرفی دوره تنها از اعداد و حروف مجاز استفاده کنید',
            'price.numeric' => 'لطفا قیمت را به صورت عدد انگلیسی وارد کنید',
            'special-price.numeric' => 'لطفا قیمت ویژه را به صورت عدد انگلیسی وارد کنید',
            'introduction.required' => 'لطفا معرفی دوره را وارد کنید'
        ];
    }
}
