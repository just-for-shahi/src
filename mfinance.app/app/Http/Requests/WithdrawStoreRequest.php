<?php

namespace App\Http\Requests;

use App\Http\Controllers\Investment\Investment;
use App\Http\Controllers\Withdraw\Withdraw;
use App\Scripts\Helpers\SessionHelper;
use App\Scripts\Helpers\ValidationHelper;
use Illuminate\Foundation\Http\FormRequest;

class WithdrawStoreRequest extends FormRequest
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
//            'bank-account' => 'required|numeric',
            'investment_id' => ValidationHelper::get('int'),
            'wallet_id' => ValidationHelper::get('ACTIVE_WALLET_ID'),
            'amount' => ValidationHelper::get('PRICE'),
//            'card'  => 'required|digits:16',
//            'no' => 'required|numeric',
//            'swift' => 'nullable|numeric',
        ];
    }

    public function store()
    {
        $investment = Investment::findOrFail($this->input('investment_id'));
        $amount = (float)$this->input('amount');

        //Get withdrawable amount from investments.
        //ensure withdrawAmount <= withdrawableAmount
        if ($investment->withdrawable_amount < $amount) {
            flash(SessionHelper::MESSAGE, 'You can only withdraw '
                . $investment->withdrawable_amount . ' from this wallet.');
            redirectTo();
        }

        $withdraw = new Withdraw();
        $withdraw->account_id = auth()->id();
        $withdraw->wallet_id = $this->input('wallet_id');
        $withdraw->investment_id = $investment->id;
        $withdraw->amount = $amount;
        $withdraw->save();

        return $withdraw;
    }
}
