<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
        'user_name', 'user_phone_number', 'index_number',
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
     * Get the rooms in which this user(technician) is responsible for
     */
    public function rooms(){
        return $this->belongsToMany('App\Room', 'rooms_technicians', 'user_id', 'room_id');
    }

    /**
     * Get bookings in which this user has requested
     */
    public function bookings(){
        return $this->hasMany('App\Booking');
    }

    /**
     * Get the roles the user has
     */
    public function roles(){
        return $this->belongsToMany('App\Role', 'users_roles', 'user_id', 'role_id');
    }

    /**
     * Find out if user is employee (has any role)
     * @return boolean
     */
    public function hasAuthority(){
        $roles = $this->roles->toArray();
        return !empty($roles);
    }

    /**
     * Find out if user has specific role
     * $return boolean
     */
    public function hasRole($role_name){
        return in_array($role_name, array_pluck($this->roles->toArray(), 'role_name')); 
    }

    /**
     * Get key in array with corresponding value
     * @return int
     */
    public function getRoleID($roles, $term){
        foreach ($roles as $key => $value) {
            if ($value == $term) {
                return $key;
            }
        }
        // throw new UnexpectedValueException;
        throw new \Exception("Unexpected Value Exception");
    }    

    /**
     * Add roles to user
     */
    public function setRole($title){
        $assigned = array();
        $roles = array_pluck(Role::all()->toArray(), 'role_name');

        switch($title){
            case 'super_admin':
                $assigned[] = $this->getRoleID($roles, 'manage_role');
                $assigned[] = $this->getRoleID($roles, 'manage_agency');
                $assigned[] = $this->getRoleID($roles, 'manage_category');                
                $assigned[] = $this->getRoleID($roles, 'manage_booking_status');
            case 'admin':
                $assigned[] = $this->getRoleID($roles, 'manage_user');
            case 'technician':
                $assigned[] = $this->getRoleID($roles, 'manage_room');
                $assigned[] = $this->getRoleID($roles, 'accept_booking');
                $assigned[] = $this->getRoleID($roles, 'reject_booking');
                $assigned[] = $this->getRoleID($roles, 'delete_booking');
            case 'normal_user':
                $assigned[] = $this->getRoleID($roles, 'create_booking');
                $assigned[] = $this->getRoleID($roles, 'edit_booking');
                $assigned[] = $this->getRoleID($roles, 'cancel_booking');
                break;
            default:
                throw new \Exception("Employee status entered doesn't exists");
        }
        $this->roles()->attach($assigned);

        // source:http://alexsears.com/article/adding-roles-to-laravel-users/
    }    

    public function isTechnician(){
        $rooms = $this->rooms->toArray();
        return !empty($rooms);
    }

    public function isSpecificTechnician($room_code){
        return in_array($room_code, array_pluck($this->rooms->toArray(), 'room_code'));
    }

    public function getRoomID($rooms, $room_code){
        foreach ($rooms as $key => $value) {
            if ($value == $room_code){
                return $key;
            }
        }
        throw new \Exception ("UnexpectedValueException");
    }
}