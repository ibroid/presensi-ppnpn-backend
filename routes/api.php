<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get("/", function () {
    return response()->json([
        "message" => "Welcome to the Presence APP API",
        "status" => "success"
    ]);
});

Route::get("/app_version", App\Http\Controllers\Api\AppVersionController::class);

Route::post("/login", App\Http\Controllers\Api\LoginController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get("/user", function (Request $request) {
        return response()->json([
            "user" => $request->user()->with("employee.employee_level")->with("role")->first()
        ]);
    });

    Route::resource("/presence", App\Http\Controllers\Api\PresenceController::class);
    Route::resource("/activity", App\Http\Controllers\Api\ActivityController::class);
});
