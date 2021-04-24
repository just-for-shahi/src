<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Expert;

class ExpertController extends Controller
{
    public function listAll(Request $request)
    {
        try {
            $experts = $request->user()->experts()->get();

            return response()->json($experts);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function get(Request $request, $id)
    {
        return response()->json(Expert::find($id, ['id','name']));
    }

    public function updateState(Request $request, $id)
    {
        $expert = Expert::find($id);

        if ($expert == false) {
            return response()->json(['success'=> false, 'message'=>'Expert not found']);
        }

        $expert->enabled = $request['enabled'];
        $expert->save();

        return response()->json(['success'=> false, 'message'=>'Expert state successfully updated. '.($request['enabled'] == 1 ? 'Enabled' : 'Disabled')]);
    }
}
