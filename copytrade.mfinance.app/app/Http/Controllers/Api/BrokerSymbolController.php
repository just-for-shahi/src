<?php

namespace App\Http\Controllers\Api;

use App\Models\BrokerSymbol;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrokerSymbolController extends Controller
{
    public function listAll(Request $request)
    {
        return response()->json(BrokerSymbol::all());
    }

}
