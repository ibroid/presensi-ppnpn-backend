<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PictureProxyController extends Controller
{
    /**
     * Function to return base64 from image url
     */
    public function __invoke(Request $request)
    {
        try {
            $pictUrl = $request->user()->employee->photos; // returh https://somesite.com/photo.jpg

            $response = file_get_contents($pictUrl);

            $base64Img = base64_encode($response);

            return response()->json([
                'base64Img' => "data:image/jpeg;base64,$base64Img",
            ]);
        } catch (\Throwable $th) {
            throw $th;
            return response()->json(["message" => $th->getMessage()], 400);
        }
    }
}
