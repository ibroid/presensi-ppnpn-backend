<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterPostRequest;
use App\Http\Traits\ErrorResponseJson;
use App\Http\Traits\TokenResponseJson;
use App\Models\User;
use App\Models\UserEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use ErrorResponseJson;
    use TokenResponseJson;
    public function __invoke(RegisterPostRequest $request)
    {
        try {
            $postdata = $request->validated();

            $user = User::create([
                "name" => $postdata["name"],
                "identifier" => $postdata["identifier"],
                "password" => Hash::make($postdata["password"]),
                "salt" => random_int(3, 5),
                "role_id" => 2,
            ]);

            UserEmployee::create([
                "user_id" => $user->id,
                "employee_id" => $postdata["employee_id"],
            ]);

            return $this->tokenResponse($user->createToken("authToken")->plainTextToken, $user);
        } catch (\Throwable $th) {
            return $this->errorResponse($th, intval($th->getCode()));
        }
    }
}
