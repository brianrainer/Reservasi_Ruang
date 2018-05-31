<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
  /**
   * The attributes that are mass assignable
   *
   * @var array
   */
  protected $fillable = [
    'routine_name', 'repeat_in_sec',
  ];

  /**
   * Set Timestamps Off
   */
  public $timestamps = false;
}