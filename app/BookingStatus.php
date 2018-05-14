<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingStatus extends Model
{
    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'booking_status_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * Set timestamps off
     */
    public $timestamps = false;

    /**
     * Get the booking time
     */
    public function bookingTimes(){
        return $this->hasMany('App\BookingTime');
    }
}
