<?php

namespace App\Console\Commands\Hue;

use App\Models\Light;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TurnOnLight extends Command
{
    use HueTrait;

    protected $signature = 'hue:turn-on-light {id}';
    protected $description = 'Turn on a light';

    public function handle()
    {
        $config = $this->getConfig();
        $id = $this->argument('id');

        // Set data.
        $data = [
            'on' => true,
        ];

        // Get lights.
        $response = Http::put(config('hue.bridge_ip').'/api/'.$config->username.'/lights/'.$id.'/state', $data);
        $response->throw();
        $response = json_decode($response->body());

        Light::where('id', $id)->update($data);
    }
}
