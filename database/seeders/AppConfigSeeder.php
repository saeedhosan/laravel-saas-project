<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\AppConfig;
use Illuminate\Database\Seeder;

class AppConfigSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        $app_config = new AppConfig();
        // $app_config->truncate();

        $appconf = $app_config->defaultSettings();

        foreach ($appconf as $conf) {
            $app_config->create($conf);
        }
    }
}
