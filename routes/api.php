<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CommuneController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RegionController;

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

Route::post('register', 'App\Http\Controllers\UserController@register');
Route::post('login', 'App\Http\Controllers\CustomerController@authenticate');

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::apiResource('commune',CommuneController::class);
    Route::apiResource('customer',CustomerController::class);
    Route::apiResource('region',RegionController::class);

});