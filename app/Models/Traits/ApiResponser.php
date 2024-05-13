<?php

namespace App\Models\Traits;

trait ApiResponser {

    /**
     * Return a success JSON response.
     *
     * @param  $data
     * @param  $message
     * @param  $code
     *
     * @return JsonResponse
     */
    public function success( $data, $message = null, int $code = 200 ): \Illuminate\Http\JsonResponse {
        return response()->json( [
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code );
    }

    /**
     * Return an error JSON response.
     *
     * @param  $message
     * @param  $code
     * @param  $data
     *
     * @return JsonResponse
     */
    public function error( $message = '', $code = null, $data = null ): \Illuminate\Http\JsonResponse {
        return response()->json( [
            'status' => 'error',
            'message' => $message,
            'data' => $data,
        ], $code );
    }
}
