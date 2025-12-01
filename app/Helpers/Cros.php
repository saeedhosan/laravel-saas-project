<?php

declare(strict_types=1);

namespace App\Helpers;

class Cros
{
    public static function allowed_origins()
    {
        if (config('app.env') === 'local') {
            return ['localhost'];
        }

        return ['appsaeed.github.io'];
    }
}
