<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscribeRequest;
use App\Models\City;
use App\Models\User;
use App\Models\UserCity;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CityController extends Controller
{
    public function index()
    {
        $userCities = City::with("weatherToday")->whereHas("users",function($q){
            return $q->where("user_id",1);
        })->get();

        dd($userCities);
        return City::all();
    }

    public function subscribeUser(SubscribeRequest $request)
    {
        $userId = $request->userId;
        $cityId = $request->cityId;

        $subscribedCity = UserCity::where([
            ["user_id","=",$userId],
            ["city_id","=",$cityId]
        ])->first();

        if($subscribedCity){
            return response(["message" => "Conflict","errors" => ["You have already subscribed to this city."]],409);
        }

        $userSubscriptions = UserCity::where("user_id",$userId)->count();

        if($userSubscriptions > 10){
            return response(["message" => "Conflict","errors" => ["You can subscribe to maximum 10 cities."]],409);
        }

        $newUserCity = new UserCity();
        $newUserCity->user_id = $request->userId;
        $newUserCity->city_id = $request->cityId;

        try {
            $newUserCity->save();
            return response(["message" => "You successfully subscribed to selected city."]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response(["message" => "Server error, try again later."],500);
        }
    }

    public function getUserCities(Request $request)
    {
        $validated = $request->validate([
            'userId' => 'required|integer|exists:users,id'
        ]);

        $userId = $request->userId;
        

        return City::whereHas("users",function($query) use($userId){
            return $query->where("user_id",$userId);
        })->get();
    }

    public function unsubscribeUser(Request $request)
    {
        $validated = $request->validate([
            "userId" => ["required","integer","exists:users,id"]
        ]);

        $userCity = UserCity::where([
            ["user_id","=",$request->userId],
            ["id","=",$request->userCityId]
        ])->first();

        if(!$userCity){
            return response(["message" => "Not found."],404);
        }

        try {
            $userCity->delete();
            return response(["message" => "You successfully unsubscribed"],200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response(["message" => "Server error, try again later"],500);
        }


    }
}
