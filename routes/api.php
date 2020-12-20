<?php

use App\Http\Controllers\Api\WebhooksController;
use Illuminate\Support\Facades\Route;

Route::post('webhooks/{token}', [WebhooksController::class, 'webhook']);
