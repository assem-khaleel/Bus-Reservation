<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\File;


class User extends Authenticatable
{
    use Notifiable;

    static $PROFILE_IMAGE = 'Profile Image';
    static $PROFILE_PASSPORT = 'Profile Passport';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','gender',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id', 'id');
    }

    function image()
    {
        return $this->morphOne(File::class,'fileable')
            ->where('description','=',User::$PROFILE_IMAGE);
    }

    function passport()
    {
        return $this->morphOne(File::class,'fileable')
            ->where('description','=',User::$PROFILE_PASSPORT);
    }
}
