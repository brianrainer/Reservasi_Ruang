<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nrp_nip', 'email', 'phone_number', 'agency_id', 'event_title', 'event_description', 'category_id', 'booking_status_id', 'poster_imagepath',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be mutated to dates.
     * 
     * @var array
     */
    protected $dates = ['deleted_at'];
    
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

    /**
     * Get the booking status
     */
    public function bookingStatus(){
        return $this->belongsTo('App\BookingStatus', 'booking_status_id');
    }
}
