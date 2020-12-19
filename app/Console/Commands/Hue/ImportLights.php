<?php

namespace App\Console\Commands\Hue;

use App\Models\Config;
use App\Models\Light;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportLights extends Command
{
    protected $signature = 'hue:import-lights';
    protected $description = 'Import lights';

    public function handle()
    {
        $config = Config::first();

        if (is_null($config)) {
            $this->warn('This application is not connected to your homebridge. Please run the hue:connect command first.');
        }

        // Get lights.
        $response = Http::get(config('hue.bridge_ip').'/api/'.$config->username.'/lights');

        // When request failed.
        $response->throw();

        // Get json response.
        $lights = json_decode($response->body());

        foreach ($lights as $hueID => $light) {
            // dd($light->state->hue);
            Light::updateOrCreate([
                'hue_id' => $hueID,
            ], [
                'name' => $light->name,
                'type' => $light->type,
                'productname' => $light->productname,
                'on' => $light->state->on,
                'brightness' => optional($light->state)->bri,
                'hue' => optional($light->state)->hue,
                'saturation' => optional($light->state)->sat,
                'reachable' => $light->state->reachable,
            ]);
        }
    }
}
