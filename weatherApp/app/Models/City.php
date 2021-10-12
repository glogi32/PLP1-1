<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class,"user_cities");
    }

    public function weather()
    {
        return $this->hasMany(Weather::class);
    }

    public function weatherToday()
    {
       return $this->hasMany(Weather::class)->whereDate("created_at","=",date("Y-m-d"));
    }
}
