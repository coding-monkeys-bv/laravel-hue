<?php

namespace App\Console\Commands\Hue;

use App\Models\Light;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class DeleteLight extends Command
{
    use HueTrait;

    protected $signature = 'hue:delete-light {id}';
    protected $description = 'Delete a light';

    public function handle()
    {
        $config = $this->getConfig();
        $id = $this->argument('id');

        $response = Http::put(config('hue.bridge_ip').'/api/'.$config->username.'/lights/'.$id);
        $response->throw();
        $response = json_decode($response->body());

        Light::where('id', $id)->delete();
    }
}
