<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = [
        'bus_name', 'total_seats', 'bus_model'
    ];

    public function booking()
    {
        return $this->hasMany(Booking::class, 'bus_id', 'id');
    }
}
