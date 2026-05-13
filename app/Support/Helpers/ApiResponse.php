<?php

namespace App\Support\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     * Generate a standardized JSON success response.
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public static function success(mixed $data = null, string $message = 'Success', int $code = 200): JsonResponse
    {
        return response()->json([
            'success'   => true,
            'status'    => $code,
            'message'   => $message,
            'payload'   => $data,
        ], $code);
    }

    /**
     * Generate a standardized JSON error response.
     * @param string $message
     * @param int $code
     * @param mixed $errors
     * @return JsonResponse
     */
    public static function error(string $message = 'Error', int $code = 400, mixed $errors = null): JsonResponse
    {
        return response()->json([
            'success'   => false,
            'status'    => $code,
            'message'   => $message,
            'errors'    => $errors,
        ], $code);
    }
}
