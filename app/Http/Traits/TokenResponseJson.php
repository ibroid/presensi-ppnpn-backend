<?php

namespace App\Http\Traits;

use App\Models\User;

trait TokenResponseJson
{
  private  function tokenResponse(string $token, User $user)
  {
    return response()->json([
      "token" => $token,
      "user" => $user
    ]);
  }
}
