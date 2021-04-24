<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BrokerServer;

class BrokerController extends Controller
{
    public function listAll(Request $request)
    {
        return response()->json(BrokerServer::get(['id', 'name']));
    }

    public function get(Request $request, $id)
    {
        return response()->json(BrokerServer::find($id, ['id','name']));
    }

    public function updateState(Request $request, $id)
    {
        $broker = BrokerServer::find($id);

        if ($broker == false) {
            return response()->json(['success'=> false, 'message'=>'Broker not found']);
        }

        $broker->enabled = $request['enabled'];
        $broker->save();

        return response()->json(['success'=> false, 'message'=>'Broker state successfully updated. '.($request['enabled'] == 1 ? 'Enabled' : 'Disabled')]);
    }
}
