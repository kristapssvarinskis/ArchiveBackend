
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
Route::middleware('auth:api')->group(function () {

    Route::get( '/logout', [LoginController::class, 'logout']);

    Route::get( '/me', [LoginController::class, 'user']);

});

Route::post('/register', [RegisterController::class, 'store']);

Route::post('/login', [LoginController::class, 'check']);

