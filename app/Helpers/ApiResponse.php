<?php

namespace App\Helpers;

class ApiResponse
{
    public static function success(
        mixed $data = null,
        string $message = 'Success',
        int $code = 200
    ) {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public static function error(
        string $message = 'Error',
        int $code = 400,
        mixed $data = null
    ) {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}