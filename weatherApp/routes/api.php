<?php

use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\WeatherController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/cities",[CityController::class,"index"]);
Route::post("/subscribtion",[CityController::class,"subscribeUser"]);
Route::delete("/unsubscribe",[CityController::class,"unsubscribeUser"]);
Route::get("/user-cities",[CityController::class,"getUserCities"]);
Route::get("/city-weather",[WeatherController::class,"getWeatherByUserName"]);
