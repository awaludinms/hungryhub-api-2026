<?php

namespace App\Traits;

trait CommonResponse
{
    /**
     * Create a new class instance.
     */
    public function success($message, $data=[])
    {
        //
        return response()->json([
            'message' => $message,
            'errors' => null,
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function failed($message, $error, $data=[])
    {
        return response()->json([
            'message' => $message,
            'errors' => (env('APP_DEBUG')) ? $error->getMessage() : 'Internal Server Error',
            'success' => false,
            'data' => $data
        ], 500);
    }
}
