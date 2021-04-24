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
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,'.auth()->id(),
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'name.required' => 'نام خود را بنویسید',
            'name.string' => 'نام شما دارای حروف غیرمجاز است',
            'name.max' => 'نام شما حداکثر 255 حرف میتواند باشد',
            'username.required' => 'نام‌کاربری خود را بنویسید',
            'username.string' => 'نام‌کاربری شما دارای حروف غیرمجازی است',
            'username.unique' => 'نام‌کاربری از قبل انتخاب شده است',
        ];
    }

}
