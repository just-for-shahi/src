<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExpertSubscription;

class ExpertSubscriptionController extends Controller
{
    public function listAll(Request $request)
    {
        return response()->json(ExpertSubscription::where('enabled', 1)->get());
    }

    public function get(Request $request, $id)
    {
        return response()->json(ExpertSubscription::find($id));
    }

    public function updateState(Request $request, $id)
    {
        $expert = ExpertSubscription::find($id);

        if ($expert == false) {
            return response()->json(['success'=> false, 'message'=>'Expert not found']);
        }

        $expert->enabled = $request['enabled'];
        $expert->save();

        return response()->json(['success'=> false, 'message'=>'ExpertSubscription state successfully updated. '.($request['enabled'] == 1 ? 'Enabled' : 'Disabled')]);
    }
}
