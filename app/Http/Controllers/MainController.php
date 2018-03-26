<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public function room(){
    	return view('room');
    }

    public function form(){
      return view('form');
    }

    public function admin(){
      return view('admin');
    }
}
