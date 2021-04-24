<?php
namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateAccountRequest;

use Illuminate\Support\Facades\Auth;

use App\Enums\Account\Country;

class Controller extends \App\Http\Controllers\Controller
{
    private $model;

    public function __construct(Account $model) {
        $this->middleware('auth');
        $this->model = $model;
    }

    public function show() {
        $account = Auth::user()->toArray();
        $country_list = Country::NAME_TO_CODE;
        $page_title = 'Show Account';
        return view('accounts.show', compact('page_title', 'account', 'country_list'));
    }

    public function update(UpdateAccountRequest $r) {
        $account = Auth::user();
        $account->first_name = $r->input('first_name');
        $account->last_name = $r->input('last_name');
        $account->country = $r->input('country');
        $account->save();

        $country_list = Country::NAME_TO_CODE;
        
        $page_title = 'Show Account';
        $msg = 'Updated successfully!';
        return view('accounts.show', compact('page_title', 'account', 'country_list', 'msg'));
    }
}
