<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\V1\{
    EventsController,
    AssetInfoController,
    NonceController,
};

Route::prefix('v1')->group(function() {

    Route::prefix('events')->group(function() {
        Route::get('/', [EventsController::class, 'eventList'])->name('api.v1.event-list');
        Route::get('{uuid}', [EventsController::class, 'eventInfo'])->name('api.v1.event-info');
    });

    Route::post('asset-info', [AssetInfoController::class, 'assetInfo'])->name('api.v1.asset-info');

    Route::post('generate-nonce', [NonceController::class, 'generateNonce'])->name('api.v1.generate-nonce');
    Route::post('validate-nonce', [NonceController::class, 'validateNonce'])->name('api.v1.validate-nonce');

});
