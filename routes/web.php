<?php

use App\Http\Controllers\ActionsController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\LightsController;
use App\Http\Controllers\WebhooksController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('actions', ActionsController::class);
    Route::resource('groups', GroupsController::class);
    Route::resource('lights', LightsController::class);
    Route::resource('webhooks', WebhooksController::class);
});
