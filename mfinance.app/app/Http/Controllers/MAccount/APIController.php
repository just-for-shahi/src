<?php


namespace App\Http\Controllers\MAccount;


use Illuminate\Http\Request;

class APIController extends \App\Http\Controllers\Controller
{

    public function update(Request $r){
        try{
            MAccount::where('username', $r->input('account'))->update([
                'balance' => $r->input('balance'),
                'equity' => $r->input('equity')
            ]);
            return response()->json(null, 200);
        }catch (\Exception $e){
            return response()->json(null, 500);
        }
    }

}
