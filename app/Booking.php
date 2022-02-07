<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'bus_id', 'seat_no','status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id', 'id');
    }
}
