<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tourist extends Model
{
    public $timestamps = false;

    public function flight()
    {
        return $this->belongsToMany('App\Flight')->withPivot('flight_id', 'tourist_id');
    }
}
