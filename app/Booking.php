<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nrp_nip', 'email', 'phone_number', 'agency_id', 'event_title', 'event_description', 'category_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * Get the category the booking has
     */
    public function category(){
        return $this->belongsTo('App\Category');
    }
    
    /**
     * Get the category the booking has
     */
    public function agency(){
        return $this->belongsTo('App\Agency');
    }

    /**
     * Get the user who proposes booking request
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * Get the booking time(s)
     */
    public function bookingTime(){
        return $this->hasMany('App\BookingDetail');
    }    

    // /**
    //  * Get the booking room(s)
    //  */
    // public function rooms(){
    //     return $this->belongsToMany('App\Room', 'bookings_times', 'booking_id', 'room_id');
    // }
}
