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
        return $this->belongsTo('App\Category', 'category_id');
    }
    
    /**
     * Get the category the booking has
     */
    public function agency(){
        return $this->belongsTo('App\Agency', 'agency_id');
    }

    /**
     * Get the booking details: room and time
     */
    public function bookingDetail(){
        return $this->hasMany('App\BookingDetail');
    }    
}
