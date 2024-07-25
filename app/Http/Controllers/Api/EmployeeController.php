<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ErrorResponseJson;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use ErrorResponseJson;
    public function list()
    {
        try {
            return response()->json(Employee::with('employee_level')->where("employee_level_id", ">", 5)->get());
        } catch (\Throwable $th) {
            return $this->errorResponse($th, intval($th->getCode()));
        }
    }
}
