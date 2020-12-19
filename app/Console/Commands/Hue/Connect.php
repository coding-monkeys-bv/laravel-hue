<?php

namespace App\Console\Commands\Hue;

use App\Models\Config;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class Connect extends Command
{
    protected $halt = false;
    protected $signature = 'hue:connect';
    protected $description = 'Connect with your Hue Bridge';

    public function handle()
    {
        // Check if device type is set.
        if (is_null(config('hue.devicetype'))) {
            $this->warn('Make sure you\'ve entered a valid device type in your env file.');
            $this->halt = true;
        }

        if (is_null(config('hue.bridge_ip'))) {
            $this->warn('Make sure you\'ve entered a valid bridge IP address in your env file.');
            $this->halt = true;
        }

        if ($this->halt) {
            return;
        }

        // Make first call.
        $response = Http::post(config('hue.bridge_ip').'/api', [
            'devicetype' => config('hue.devicetype'),
        ]);

        // When request failed.
        $response->throw();

        // Get json response.
        $response = json_decode($response->body());

        // Check if an important message returned.
        if (property_exists($response[0], 'error')) {
            if ($response[0]->error->type == 101) {
                $this->warn('Press the homebridge button and rerun this command.');

                return;
            }
        }

        // When application is linked, get generated username.
        if (property_exists($response[0], 'success')) {
            Config::updateOrCreate(['id' => 1], ['username' => $response[0]->success->username]);
            $this->info('All done!');
        }
    }
}
