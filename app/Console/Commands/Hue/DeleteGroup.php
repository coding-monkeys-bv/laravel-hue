<?php

namespace App\Console\Commands\Hue;

use App\Models\Group;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class DeleteGroup extends Command
{
    use HueTrait;

    protected $signature = 'hue:delete-group {id}';
    protected $description = 'Delete a group';

    public function handle()
    {
        $config = $this->getConfig();
        $id = $this->argument('id');

        $response = Http::put(config('hue.bridge_ip').'/api/'.$config->username.'/groups/'.$id);
        $response->throw();
        $response = json_decode($response->body());

        Group::where('id', $id)->delete();
    }
}
