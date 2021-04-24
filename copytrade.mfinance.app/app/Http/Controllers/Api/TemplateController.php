<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountExpertTemplate;
use App\Models\Expert;
use App\Models\Account;

class TemplateController extends Controller
{
    public function listAll(Request $request)
    {
        $user_id = $request->user()->id;

        $data = AccountExpertTemplate
            ::whereHas('account', static function($q) use($user_id) { $q->whereUserId($user_id); })
            //->where('enabled', 1)
            ->get();

        return response()->json($data);
    }

    public function get(Request $request, $id)
    {
        return response()->json(AccountExpertTemplate::find($id));
    }

    public function delete(Request $request, $id)
    {
        $template = AccountExpertTemplate::find($id);

        if ($template == false) {
            return response()->json(['success'=> false, 'message'=>'AccountExpertTemplate not found']);
        }

        $template->delete();

        return response()->json(['success'=> true, 'message'=>'AccountExpertTemplate removed']);
    }

    public function updateState(Request $request, $id)
    {
        $template = AccountExpertTemplate::find($id);

        if ($template == false) {
            return response()->json(['success'=> false, 'message'=>'AccountExpertTemplate not found']);
        }

        $template->enabled = $request['enabled'];
        $template->save();

        return response()->json(['success'=> true, 'message'=>'Template state successfully updated. '.($request['enabled'] == 1 ? 'Enabled' : 'Disabled')]);
    }

    public function create(Request $request)
    {
        $info = $request->only('timeframe', 'symbol', 'expert_id', 'enabled', 'account_id', 'options');
        $rules = [
            'account_id' => 'required|numeric',
            'expert_id' => 'required|numeric',
            'symbol' => 'required',
            'options' => 'required',
            'timeframe' => 'required|numeric',
        ];
        $validator = Validator::make($info, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()]);
        }

        $expert = Expert::find($request['expert_id']);

        if ($expert == false) {
            return response()->json(['success' => false, 'message' => 'Expert does not exists']);
        }

        $account = Account::find($request['account_id']);

        if ($account == false) {
            return response()->json(['success' => false, 'message' => 'Account does not exists']);
        }

        $template = new AccountExpertTemplate();

        $template->timeframe = $request['timeframe'];
        $template->symbol = $request['symbol'];
        $template->options = $request['options'];
        $template->expert_id = $request['expert_id'];
        $template->account_id = $request['account_id'];

        if (!empty($request['enabled'])) {
            $template->enabled = $request['enabled'];
        } else {
            $template->enabled = 1;
        }

        $template->save();

        return response()->json(['success' => true, 'message' => 'Successfully created', 'item' => $template]);
    }
}
