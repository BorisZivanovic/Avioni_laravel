<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

Route::middleware('auth:api')->group( function () {
    Route::post('logout', [UserController::class, 'logout']);
    Route::post('refresh', [UserController::class, 'refresh']);
    Route::post('revokeToken', [UserController::class, 'revokeToken']);
    Route::resource('tipovi', \App\Http\Controllers\TipController::class);
    Route::resource('proizvodjaci', \App\Http\Controllers\ProizvodjacController::class);
    Route::resource('avioni', \App\Http\Controllers\AvionController::class);
    Route::resource('letovi', \App\Http\Controllers\LetController::class);
});
