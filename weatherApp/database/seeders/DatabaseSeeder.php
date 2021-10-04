<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        foreach(file(public_path("assets/gradovi.txt")) as $cityName){
            $city = new City();
            $city->name = $cityName;
            $city->save();
        }
    }
}
