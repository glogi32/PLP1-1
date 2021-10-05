<?php

namespace App\Console\Commands;

use App\Models\City;
use GuzzleHttp\Client;
use App\Models\Weather;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AddWeatherCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Client $httpClient)
    {
        $cities = City::all();

        foreach ($cities as $city) {
                $request = $httpClient->get("https://api.openweathermap.org/data/2.5/weather?appid=283ffcd4756f546f71f2e37f52c59bd9&units=metric&q=".$city->name);
                $response = json_decode($request->getBody()->getContents());

                $newWeather = new Weather();
                $newWeather->main = $response->weather[0]->main;
                $newWeather->description = $response->weather[0]->description;
                $newWeather->temp = $response->main->temp;
                $newWeather->temp_min = $response->main->temp_min;
                $newWeather->temp_max = $response->main->temp_max;
                $newWeather->pressure = $response->main->pressure;
                $newWeather->humidity = $response->main->humidity;
                $newWeather->city_id = $city->id;

                try {
                    $newWeather->save();
                } catch (\Throwable $th) {
                    Log::error($th->getMessage());
                }
            }
    }
}
