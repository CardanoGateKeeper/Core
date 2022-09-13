<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\V1\{
    NonceController,
};

Route::prefix('v1')->group(function() {

    Route::post('nonce', [NonceController::class, 'index'])->name('api.v1.nonce');

});
