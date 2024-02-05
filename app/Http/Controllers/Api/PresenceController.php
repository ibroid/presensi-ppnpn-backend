<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PresencePostRequest;
use App\Http\Traits\ErrorResponseJson;
use App\Models\DailyPresence;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PresenceController extends Controller
{
    use ErrorResponseJson;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            return response()->json(DailyPresence::where([
                "employee_id" => $request->user()->employee->id,
                "present_date" => date("Y-m-d"),
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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PresencePostRequest $request)
    {
        try {
            $postdata = $request->validated();

            $checkPresent = DailyPresence::where([
                "employee_id" => $request->user()->employee->id,
                "session" => $postdata["session"],
                "present_date" => date("Y-m-d"),
            ])->first();

            if ($checkPresent) {
                throw new BadRequestHttpException("Anda sudah presensi diwaktu ini", null, 400);
            }

            $presence = DailyPresence::create([
                "session" => $postdata["session"],
                "location" => $postdata["location"],
                "employee_id" => $request->user()->employee->id,
                "present_date" => date("Y-m-d"),
                "present_time" => date("H:i:s"),
                "status" => "1",
            ]);

            return response()->json([
                "message" => "Presence added successfully",
                "status" => "success",
                "data" => $presence,
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