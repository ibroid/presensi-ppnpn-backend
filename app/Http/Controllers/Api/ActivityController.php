<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityPostRequest;
use App\Http\Traits\ErrorResponseJson;
use App\Models\DailyActivity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    use ErrorResponseJson;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            return response()
                ->json(DailyActivity::where([
                    "doing_date" => date("Y-m-d"),
                    "employee_id" => $request->user()->employee->id,
                ])->get());
        } catch (\Throwable $th) {
            return $this->errorResponse($th, intval($th->getCode()));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityPostRequest $request)
    {
        try {
            $postdata = $request->validated();

            $data = DailyActivity::create([
                "doing" => $postdata["doing"],
                "employee_id" => $request->user()->employee->id,
                "doing_date" => date("Y-m-d"),
                "doing_time" => $postdata['doing_time'],
                "note" => $postdata["note"],
            ]);

            return response()->json([
                "message" => "Success mengisi aktivitas kebersihan",
                "status" => "success",
                "data" => $data
            ]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th, intval($th->getCode()));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
