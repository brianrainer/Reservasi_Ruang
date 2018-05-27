<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
  protected $fillable = [
    'routine_name', 'repeat_in_sec',
  ];

  public $timestamps = false;
}