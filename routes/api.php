<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function (): void {
    Route::get('contacts', [ContactController::class, 'index']);
    Route::get('campaigns', [CampaignController::class, 'index']);
});
