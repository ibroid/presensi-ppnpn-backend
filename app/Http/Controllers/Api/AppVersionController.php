<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppVersion;
use App\Models\ServerVariable;
use Illuminate\Http\Request;

class AppVersionController extends Controller
{
  public function __invoke()
  {
    return response()->json(
      [
        "app_version" => AppVersion::current()->full_app_version,
        "server_variable" => ServerVariable::all()->pluck("value", "key")->toArray(),
      ]
    );
  }
}
