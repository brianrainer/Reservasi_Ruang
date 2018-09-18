<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'room_code', 'room_name', 'room_imagepath',
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
     * Get the user who is technician of the room
     */
    public function technicians(){
        return $this->belongsToMany('App\User', 'rooms_technicians', 'room_id', 'user_id');
    }

    /**
     * Get the booking in which the room is used
     */
    public function bookingDetail(){
        return $this->hasMany('App\BookingDetail');
    }

    public function addTechnician($user_id){
        $this->technicians()->attach($user_id);
    }

    public function hasTechnicians(){
        $techs = $this->technicians->toArray();
        return !empty($techs);      
    }
}