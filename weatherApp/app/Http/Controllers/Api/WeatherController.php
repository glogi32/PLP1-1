<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function getWeatherByUserName(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $username = $request->name;

        return City::with("weatherToday")->whereHas("users",function($q) use($username){
            return $q->where("users.name","like","%".$username."%");
        })->get();
    }
}
