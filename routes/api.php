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
Route::get("/pegawais", [App\Http\Controllers\Api\EmployeeController::class, "list"]);

Route::post("/login", App\Http\Controllers\Api\LoginController::class);
Route::post("/register", App\Http\Controllers\Api\RegisterController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get("/user", function (Request $request) {
        $request->user()->role;
        $request->user()->employee;
        $request->user()->employee->employee_level;
        return response()->json([
            "user" => $request->user()
        ]);
    });

    Route::resource("/presence", App\Http\Controllers\Api\PresenceController::class);
    Route::resource("/activity", App\Http\Controllers\Api\ActivityController::class);
});
