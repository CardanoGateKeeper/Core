<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\V1\{
    AssetInfoController,
    NonceController,
};

Route::prefix('v1')->group(function() {

    Route::post('asset-info', [AssetInfoController::class, 'index'])->name('api.v1.asset-info');

    Route::post('generate-nonce', [NonceController::class, 'generateNonce'])->name('api.v1.generate-nonce');
    Route::post('validate-nonce', [NonceController::class, 'validateNonce'])->name('api.v1.validate-nonce');

});
