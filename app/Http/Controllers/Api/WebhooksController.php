<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Webhook;
use Illuminate\Support\Facades\Artisan;

class WebhooksController extends Controller
{
    public function webhook($token)
    {
        $webhook = Webhook::where('token', $token)->first();

        if (is_null($webhook)) {
            abort(404);
        }

        Artisan::call('hue:run-action '.$webhook->action_id.' --type="'.$webhook->type.'" --id="'.$webhook->hue_id.'"');
    }
}
