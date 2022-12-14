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

Route::post('customer', 'App\Http\Controllers\CustomerController@store');
Route::post('commune', 'App\Http\Controllers\CommuneController@store');
Route::post('region', 'App\Http\Controllers\RegionController@store');
Route::post('login', 'App\Http\Controllers\CustomerController@authenticate');

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::apiResource('commune',CommuneController::class,['except' => ['store']]);
    Route::apiResource('customer',CustomerController::class,['except' => ['store']]);
    Route::apiResource('region',RegionController::class,['except' => ['store']]);

});