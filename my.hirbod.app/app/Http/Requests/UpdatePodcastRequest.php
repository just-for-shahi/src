<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePodcastRequest extends FormRequest
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
            'logo' => 'nullable|image',
            'cover' => 'nullable|image',
            'description' => 'nullable|string',
            'website' => 'nullable|url'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'لطفا عنوان پادکست را وارد کنید',
            'title.string' => 'لطفا تنها از حروف و اعداد برای عنوان پادکست استفاده کنید',
            'logo.nullable' => 'لطفا لوگوی پادکست را انتخاب کنید',
            'logo.image' => 'لطفا لوگوی پادکست را فقط از تصاویر انتخاب کنید',
            'cover.nullable' => 'لطفا کاور پادکست را انتخاب کنید',
            'cover.image' => 'لطفا کاور پادکست را از تصاویر انتخاب کنید',
            'description.string' => 'لطفا برای معرفی پادکست تنها از اعداد و حروف مجاز استفاده کنید',
            'website.url' => 'لطفا برای آدرس وب سایت تنها از کاراکترهای مجاز استفاده کنید',
        ];
    }
}
