<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\V1\{
    NonceController,
    AssetInfoController,
};

Route::prefix('v1')->group(function() {

    Route::post('nonce', [NonceController::class, 'index'])->name('api.v1.nonce');

    Route::post('asset-info', [AssetInfoController::class, 'index'])->name('api.v1.asset-info');

});
