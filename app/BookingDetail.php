<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_start', 'event_end', 'room_id', 'booking_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * Get the booking
     */
    public function booking(){
        return $this->belongsTo('App\Booking', 'booking_id');
    }

    /**
     * Get the booking rooms
     */
    public function room(){
        return $this->belongsTo('App\Room', 'room_id');
    }

}
