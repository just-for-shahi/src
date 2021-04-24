<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'identity_card_front' => 'image|max:100000',
            'identity_card_back' => 'image|max:100000',
            'confession' => 'image|max:100000',
            'residential' => 'image|max:100000',
            //'username' => 'required|string|unique:users,username,'.auth()->id(),
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'نام خود را بنویسید',
            'first_name.string' => 'نام شما دارای حروف غیرمجاز است',
            'first_name.max' => 'نام شما حداکثر 255 حرف میتواند باشد',
            'last_name.required' => 'نام‌خانوادگی خود را بنویسید',
            'last_name.string' => 'نام‌خانوادگی شما دارای حروف غیرمجاز است',
            'last_name.max' => 'نام‌خانوادگی شما حداکثر 255 حرف میتواند باشد',
            //'username.required' => 'نام‌کاربری خود را بنویسید',
            //'username.string' => 'نام‌کاربری شما دارای حروف غیرمجازی است',
            //'username.unique' => 'نام‌کاربری از قبل انتخاب شده است',
        ];
    }
}
