<?php

namespace App\Mail;

use App\Models\City;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Decimal;

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
        foreach ($userCities as $city) {

            if(!empty($city->weatherToday[0])){

                $temp = (float)$city->weatherToday[0]->temp;
                switch ($temp) {
                    case ($temp > 22):
                        $city->advice = "Anything that makes you feel comfortable";
                        break;
                    case ($temp <= 22 && $temp > 15.5):
                        $city->advice = "Shorts and short-sleeve jersey.";
                        break;
                    case ($temp <= 15.5 && $temp > 10):
                        $city->advice = "Shorts and long-sleeve jersey or long-sleeve thin undershirt.";
                        break;  
                    case ($temp <= 10 && $temp > 7):
                        $city->advice = "Tights or leg warmers; long-sleeve wicking undershirt and lined cycling jacket; 
                        thin full-fingered gloves; headband covering ears; wool socks and shoe covers.";
                        break;
                    case ($temp <= 7 && $temp > 4.4):
                        $city->advice = "Tights or leg warmers; long-sleeve heavy mock turtleneck (I like Under Armour) and lined cycling jacket;
                        medium-weight gloves; headband covering ears;  winter cycling shoes, shoe covers, wool socks.";
                        break;      
                    case ($temp <= 4.4 && $temp > 1.7):
                        $city->advice = "Heavyweight tights; long-sleeve heavy wicking turtleneck undershirt and heavy cycling jacket; heavy-weight gloves; headband covering ears;
                        winter cycling shoes, shoe covers, wool socks with charcoal toe warmers.";
                        break;   
                    case ($temp <= 1.7 && $temp > -3.9):
                        $city->advice = "Winter bib tights; long-sleeve heavy wicking full turtleneck undershirt, long-sleeve jersey and lined cycling jacket; mittens or
                        lobster claw gloves; balaclava; winter cycling shoes, wool socks, plastic bag, charcoal toe warmers.";
                        break; 
                    case ($temp <= -3.9):
                        $city->advice = "Winter bib tights; long-sleeve heavy wicking full turtleneck undershirt, long-sleeve jersey and lined cycling jacket; mittens or
                        lobster claw gloves; balaclava; winter cycling shoes, wool socks, plastic bag, charcoal toe warmers.";
                        break;   
                    default:
                        $city->advice = "Wear whatever the hell you want!";
                        break;
                }
            }
            
            
        }

        return $this->from("weatherApp@gmail.com", "Weather App")
                    ->view("mails.weather-info")
                    ->with(["userCities" => $userCities]);
    }
}
