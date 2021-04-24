<?php

namespace App\Http\Controllers\Api;

use App\Models\AccountStat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderEquity;

class ReportController extends Controller
{
    /**
     * @param Request $request
     * @param $accountNumber
     * @return JsonResponse
     */
    public function equity(Request $request, $accountNumber)
    {
        return response()->json(OrderEquity::whereAccountNumber($accountNumber)->orderBy('date_at', 'ASC')->get());
    }

    /**
     * @param Request $request
     * @param $accountNumber
     * @return JsonResponse
     */
    public function stat(Request $request, $accountNumber)
    {
        return response()->json(AccountStat::find($accountNumber));
    }

    /**
     * @param Request $request
     * @param $accountNumber
     * @return JsonResponse
     */
    public function advanced(Request $request, $accountNumber)
    {
        $stat = AccountStat::find($accountNumber);
        if ($stat) {
            return response()->json($stat->advanced());
        }

        return response()->json([]);
    }

    public function weekly(Request $request, $accountNumber)
    {
        $stat = AccountStat::find($accountNumber);
        if ($stat) {
            return response()->json($stat->weekly());
        }

        return response()->json([]);
    }
}
