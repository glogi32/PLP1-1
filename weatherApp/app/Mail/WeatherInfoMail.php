<?php

namespace App\Mail;

use App\Models\City;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class WeatherInfoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userId;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $userCities = City::with("weatherToday")->whereHas("users",function($q){
            return $q->where("user_id",$this->userId);
        })->get();

        return $this->from("weatherApp@gmail.com", "Weather App")
                    ->view("mails.weather-info",["userCities" => $userCities]);
    }
}
