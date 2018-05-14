<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingTime extends Model
{
    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_start', 'event_end',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * Get the booking status
     */
    public function bookingStatus(){
        return $this->belongsTo('App\BookingStatus');
    }

    /**
     * Get the booking
     */
    public function bookings(){
        return $this->belongsTo('App\Booking');
    }


}
