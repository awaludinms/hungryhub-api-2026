<?php

namespace App\Traits;

trait CommonResponse
{
    /**
     * Create a new class instance.
     */
    public function success($message)
    {
        //
        return response()->json([
            'message' => $message,
            'errors' => null,
            'success' => true,
        ], 200);
    }

    public function failed($message, $error)
    {
        return response()->json([
            'message' => $message,
            'errors' => (env('APP_DEBUG')) ? $error->getMessage() : 'Internal Server Error',
            'success' => false,
        ], 500);
    }
}
