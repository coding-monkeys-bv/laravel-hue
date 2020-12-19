<?php

namespace App\Console\Commands\Hue;

use App\Models\Config;
use App\Models\Group;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportGroups extends Command
{
    protected $signature = 'hue:import-groups';
    protected $description = 'Import groups';

    public function handle()
    {
        $config = Config::first();

        if (is_null($config)) {
            $this->warn('This application is not connected to your homebridge. Please run the hue:connect command first.');
        }

        // Get lights.
        $response = Http::get(config('hue.bridge_ip').'/api/'.$config->username.'/groups');

        // When request failed.
        $response->throw();

        // Get json response.
        $groups = json_decode($response->body());

        foreach ($groups as $hueID => $group) {
            $selectedGroup = Group::updateOrCreate([
                'hue_id' => $hueID,
            ], [
                'name' => $group->name,
                'type' => $group->type,
                'class' => ($group->class) ?? null,
                'all_on' => $group->state->all_on,
                'any_on' => $group->state->any_on,
            ]);

            $selectedGroup->lights()->sync($group->lights);
        }
    }
}
