<?php

namespace App\Console\Commands\Hue;

use App\Models\Config;
use App\Models\Group;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncGroups extends Command
{
    use HueTrait;

    protected $config;
    protected $signature = 'hue:sync-groups {group?}';
    protected $description = 'Sync groups';

    public function handle()
    {
        $this->config = $this->getConfig();

        (is_null($this->argument('group')))
            ? $this->syncAllGroups()
            : $this->syncSingleGroup($this->argument('group'));
    }

    // Sync a single group.
    public function syncSingleGroup(String $id)
    {
        $response = Http::get(config('hue.bridge_ip').'/api/'.$this->config->username.'/groups/'.$id);
        $response->throw();

        $group = json_decode($response->body());

        $this->syncGroup($id, $group);
    }

    // Sync all groups.
    public function syncAllGroups()
    {
        $response = Http::get(config('hue.bridge_ip').'/api/'.$this->config->username.'/groups');
        $response->throw();

        $groups = json_decode($response->body());

        foreach ($groups as $id => $group) {
            $this->syncGroup($id, $group);
        }
    }

    // Sync a group.
    public function syncGroup($id, $group)
    {
        $selectedGroup = Group::withTrashed()->updateOrCreate([
            'id' => $id,
        ], [
            'name' => $group->name,
            'type' => $group->type,
            'class' => ($group->class) ?? null,
            'all_on' => $group->state->all_on,
            'any_on' => $group->state->any_on,
        ]);

        if (! $selectedGroup->trashed()) {
            $selectedGroup->lights()->sync($group->lights);
        }
    }
}
