<?php

declare(strict_types=1);

namespace App\Models\Traits;

trait ApiResponser
{
    /**
     * Return a success JSON response.
     *
     *
     * @return JsonResponse
     */
    public function success($data, $message = null, int $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status'  => 'success',
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    /**
     * Return an error JSON response.
     *
     *
     * @return JsonResponse
     */
    public function error($message = '', $code = null, $data = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status'  => 'error',
            'message' => $message,
            'data'    => $data,
        ], $code);
    }
}
