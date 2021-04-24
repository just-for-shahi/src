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

    /**
     * @return array
     */
    public function messages(){
        return [
            'message.required' => 'لطفا متن پاسخ خود را وارد کنید',
            'message.string' => 'لطفا از کاراکترهای مجاز استفاده کنید',
        ];
    }
}
