<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    public $timestamps = false;

    public function tourist()
    {
        return $this->belongsToMany('App\Tourist')->withPivot('flight_id', 'tourist_id');
    }
}
