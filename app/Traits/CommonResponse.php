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
            'success' => true,
        ]);
    }

    public function failed($message)
    {
        return response()->json([
            'message' => $message,
            'success' => false,
        ]);
    }
}
