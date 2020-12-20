<?php

namespace App\Console\Commands\Hue;

use App\Models\Config;

trait HueTrait
{
    public function getConfig()
    {
        $config = Config::first();

        if (is_null($config)) {
            $this->warn('This application is not connected to your homebridge. Please run the hue:connect command first.');

            exit;
        }

        return $config;
    }
}
