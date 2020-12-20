<?php

namespace App\Console\Commands\Hue;

use App\Models\Light;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncLights extends Command
{
    use HueTrait;

    protected $signature = 'hue:sync-lights';
    protected $description = 'Sync lights';

    public function handle()
    {
        $config = $this->getConfig();

        // Get lights.
        $response = Http::get(config('hue.bridge_ip').'/api/'.$config->username.'/lights');

        // When request failed.
        $response->throw();

        // Get json response.
        $lights = json_decode($response->body());

        foreach ($lights as $id => $light) {
            // dd($light->state->hue);
            Light::updateOrCreate([
                'id' => $id,
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
