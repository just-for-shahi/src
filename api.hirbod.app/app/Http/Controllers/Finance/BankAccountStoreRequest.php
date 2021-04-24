<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Foundation\Http\FormRequest;

class BankAccountStoreRequest extends FormRequest
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
            'iban' => 'required|string|max:26|unique:bank_accounts,iban',
            'card' => 'nullable|max:16|min:16|unique:bank_accounts,card',
            'account' => 'nullable|max:16|unique:bank_accounts,account',
        ];
    }
}
