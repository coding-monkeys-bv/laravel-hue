<?php

namespace App\Console\Commands\Hue;

use App\Models\Action;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class RunAction extends Command
{
    use HueTrait;

    protected $signature = 'hue:run-action {action} {--type=} {--id=}';
    protected $description = 'Run action';

    public function handle()
    {
        $config = $this->getConfig();

        $id = $this->option('id');
        $type = $this->option('type');
        $action = Action::findOrFail($this->argument('action'));
        $data = $action->action;

        $url = ($type == 'groups')
            ? config('hue.bridge_ip').'/api/'.$config->username.'/groups/'.$id.'/action'
            : config('hue.bridge_ip').'/api/'.$config->username.'/lights/'.$id.'/state';

        $response = Http::put($url, $data);
        $response->throw();
    }
}
