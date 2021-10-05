<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function getWeatherByUserName(Request $request)
    {
        $username = $request->name;

        return City::with("weather")->whereHas("users",function($q) use($username){
            return $q->where("users.name","like","%".$username."%");
        })->get();
    }
}
