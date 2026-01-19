<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return JsonResponse
     */
    public function sendResponse($result, $code =200)
    {
        $response = [
            'data'    => $result
        ];
        return response()->json($response, $code)->header('Content-Type', 'application/json');
    }


    /**
     * return error response.
     *
     * @return JsonResponse
     */
    public function sendError($errors, $code = 404)
    {
        $response = [
            'error' => [
                'code' => $code,
                'message' => $errors,
            ]
        ];
        return response()->json($response, $code)->header('Content-Type', 'application/json');
    }
}
