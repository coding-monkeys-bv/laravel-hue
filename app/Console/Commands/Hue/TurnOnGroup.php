<?php

namespace App\Console\Commands\Hue;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

class TurnOnGroup extends Command
{
    use HueTrait;

    protected $signature = 'hue:turn-on-group {id}';
    protected $description = 'Turn on a group';

    public function handle()
    {
        $config = $this->getConfig();
        $id = $this->argument('id');

        // Set data.
        $data = [
            'on' => true,
        ];

        $response = Http::put(config('hue.bridge_ip').'/api/'.$config->username.'/groups/'.$id.'/action', $data);
        $response->throw();

        $response = json_decode($response->body());

        Artisan::call('hue:sync-groups '.$id);
    }
}
