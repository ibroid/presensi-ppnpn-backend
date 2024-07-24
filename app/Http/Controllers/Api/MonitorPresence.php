<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Report\PresenceReport;
use Illuminate\Http\Request;

class MonitorPresence extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $data['list'] = PresenceReport::dailyData($request->get('date') ?? date("Y-m-d"));

            $data['total_sudah'] = $data['list']->filter(function ($item) {
                return $item->masuk !== null;
            })->count();

            $data['total_belum'] = $data['list']->filter(function ($item) {
                return $item->masuk == null;
            })->count();

            return response()->json($data, 200);
        } catch (\Throwable $th) {

            return response()->json([
                "message" => $th->getMessage()
            ], 500);
        }
    }
}
