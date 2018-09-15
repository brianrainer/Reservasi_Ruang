<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class StaffController extends Controller
{
    public function index(){
        $data['users'] = User::paginate(10);

        return view('staff.index', $data);
    }

    public function edit($user_id){
      $data['user'] = User::find($user_id);

      return view('staff.form-update', $data);
    }

    public function create(){
    	return view('staff.form-create');
    }

    public function update(Request $request, $user_id){
    	$data = $request;
    	$user = User::find($user_id);
    	if ($request->password == null){
    		$data->password = $user->password;
    	}
    	else{
    		dd('asd');
    		$data->password = bcrypt($request->password);
    	}
    	dd($data->toArray());
    	$user->update($data->toArray());

    	return redirect('/staff');
    }
}
