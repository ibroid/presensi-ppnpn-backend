<?php

namespace App\Http\Traits;

trait ErrorResponseJson
{
  private function errorResponse(\Throwable $err, int $status)
  {
    return response()->json([
      "error" => [
        "code" => $err->getCode(),
        "message" => $err->getMessage(),
        "file" => $err->getFile(),
        "line" => $err->getLine(),
        "trace" => $err->getTrace(),
        "previous" => $err->getPrevious(),
      ]
    ], ($status > 400 && $status < 500) ? $status : 500);
  }
}
