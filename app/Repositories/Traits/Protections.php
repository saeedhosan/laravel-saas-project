<?php

declare(strict_types=1);

namespace App\Repositories\Traits;

trait Protections
{
    public function checks()
    {
        return auth()->id() !== 1 && config('app.stage') === 'demo';
    }

    /**
     * create a new error array with message and status
     *
     * @param  string  $message
     * @param  string|int  $code
     * @return array
     */
    public function error($message = '', $code = null)
    {
        $response            = [];
        $response['status']  = 'error';
        $response['message'] = $message;
        if ($code) {
            $response['code'] = $code;
        }

        return $response;
    }
}

// / $this->checks()
