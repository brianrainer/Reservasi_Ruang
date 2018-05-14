<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_name',
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
     * Get the bookings which is in this category type
     */
    public function bookings(){
        return $this->hasMany('App\Booking');
    }
}
