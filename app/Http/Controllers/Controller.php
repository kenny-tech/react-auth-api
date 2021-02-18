<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendSuccess($data, $message, $code = 200)
    {
        $response = [
            'success' => 'true',
            'data' => $data,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    public function sendError($data, $message, $code = 404)
    {
        $response = [
            'success' => 'false',
            'data' => $data,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

}
