<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_name',
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
    public function users(){
        return $this->belongsToMany('App\User', 'users_roles', 'role_id', 'user_id');
    }
}
