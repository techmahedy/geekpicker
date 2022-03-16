<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WalletController;

Route::controller(AuthController::class)->group(function () {

    Route::post('/register', 'register');
    Route::post('/login', 'login');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('logout', 'logout');
    });

});


Route::controller(WalletController::class)->group(function () {
    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('deposit', 'deposit');
    });
});

