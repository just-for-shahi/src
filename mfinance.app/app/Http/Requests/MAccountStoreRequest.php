<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MAccountStoreRequest extends FormRequest
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
            'broker' => 'required|numeric|between:0,7',
            'username' => 'required|string|unique:maccounts',
            'password' => 'required|string',
            'investor-password' => 'required|string',
            'server' => 'required|string',
            'report' => 'required|numeric|between:0,6',
            'dashboard' => 'required|numeric|between:0,1'
        ];
    }
}
