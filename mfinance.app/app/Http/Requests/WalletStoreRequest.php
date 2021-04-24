<?php

namespace App\Http\Requests;

use App\Enums\Wallet\Currency;
use App\Scripts\Helpers\ValidationHelper;
use Illuminate\Foundation\Http\FormRequest;

class WalletStoreRequest extends FormRequest
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
            'currency' => ValidationHelper::inArray([
                Currency::USDT,
                Currency::BNB,
                Currency::PAX,
                Currency::TUSD
            ]),
            'address' => ValidationHelper::get('STRING'),
            'default' => 'required|boolean',
            'dashboard' => 'required|boolean'
        ];
    }
}
