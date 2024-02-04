<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginPostRequest;
use App\Http\Traits\ErrorResponseJson;
use App\Http\Traits\TokenResponseJson;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LoginController extends Controller
{
    use ErrorResponseJson;
    use TokenResponseJson;

    public function __invoke(LoginPostRequest $request)
    {
        try {
            $data = $request->validated();

            $user = User::with("employee.employee_level")->with("role")->where("identifier", "=", $data["phone"])->first();

            if (!$user) {
                throw new NotFoundHttpException("User not found", null, 404);
            }

            if (!password_verify($data["password"], $user->password)) {
                throw new BadRequestHttpException("Wrong password", null, 400);
            }

            return $this->tokenResponse($user->createToken("authToken")->plainTextToken, $user);
        } catch (\Throwable $th) {
            return $this->errorResponse($th, intval($th->getCode()));
        }
    }
}
