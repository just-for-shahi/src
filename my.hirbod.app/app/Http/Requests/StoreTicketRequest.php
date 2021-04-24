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
            'title' => 'required|string',
            'department' => 'required|numeric|between:0,7',
            'priority' => 'required|numeric|between:0,2',
            'attachment' => 'nullable|file',
            'message' => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages(){
        return [
            'title.required' => 'لطفا عنوان تیکت پشتیبانی را وارد کنید',
            'title.string' => 'لطفا برای عنوان تیکت از کاراکترهای مجاز استفاده کنید',
            'department.required' => 'لطفا دپارتمان مربوطه را انتخاب کنید',
            'department.numeric' => 'لطفا دپارتمان مربوطه را انتخاب کنید',
            'department.between' => 'لطفا یک دپارتمان مجاز انتخاب کنید',
            'priority.required' => 'لطفا سطح اهمیت تیکت را انتخاب کنید',
            'priority.numeric' => 'لطفا سطح اهمیت تیکت را انتخاب کنید',
            'priority.between' => 'لطفا سطح اهمیت مجاز انتخاب کنید',
            'attachment.file' => 'لطفا فقط فایل‌های مجاز انتخاب کنید',
            'message.required' => 'لطفا متن تیکت خود را وارد کنید',
            'message.string' => 'لطفا برای متن تیکت از کاراکترهای مجاز استفاده کنید',
        ];
    }
}
