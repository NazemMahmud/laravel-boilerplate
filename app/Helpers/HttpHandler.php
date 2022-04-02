<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class HttpHandler
{
    /**
     * API error response
     *
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function errorMessage(string $message, int $statusCode = 500): JsonResponse
    {
        return response()->json([
            'data' => [
                'message' => $message,
            ],
        ], $statusCode);
    }

    /**
     * API success response
     *
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function successMessage(string $message, int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'data' => [
                'message' => $message,
            ],
        ], $statusCode);
    }

}
