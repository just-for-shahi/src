<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketReplyRequest extends FormRequest
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
            'message' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'message.required' => 'لطفا پاسخ خود را وارد کنید',
            'message.string' => 'پاسخ شما حاوی کاراکتر غیرمجازی است',
        ];
    }
}
