<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Watson\Rememberable\Rememberable;


class Bus extends Model
{

    use Rememberable;


    protected $fillable = [
        'bus_name', 'total_seats', 'bus_model'
    ];

    public function booking()
    {
        return $this->hasMany(Booking::class, 'bus_id', 'id');
    }
}
