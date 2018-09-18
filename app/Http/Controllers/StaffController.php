<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;

class StaffController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    protected function create_validator($request){
      return Validator::make($request->all(), [
        'user_name' => 'required|string|max:100',
        'email' => 'required|email|max:100',
        'nrp_nip' => 'nullable|string|min:10|max:20',
        'user_phone_number' => 'nullable|numeric',
        'password' => 'required|confirmed' 
      ], [
        'full_name.required' => 'Nama harus diisi',
        'nrp_nip.min' => 'Gunakan NRP / NIP lengkap',
        'nrp_nip.max' => 'NRP / NIP terlalu panjang, silahkan coba lagi',
        'user_phone_number.required' => 'Nomor Telepon Dibutuhkan',
        'user_phone_number.numeric' => 'Nomor Telepon harus berupa angka',
        'email.required' => 'Email Dibutuhkan',
        'email.email'=> 'Email harus menggunakan format email yang benar',
        'password.required' => 'Password harus diisi',
        'password.confirmed' => 'Password tidak sesuai'
      ]);
    }
   
    protected function update_validator($request){
      return Validator::make($request->all(), [
        'user_name' => 'required|string|max:100',
        'email' => 'required|email|max:100',
        'nrp_nip' => 'nullable|string|min:10|max:20',
        'user_phone_number' => 'nullable|numeric',
        'new_password' => 'nullable|confirmed' 
      ], [
        'full_name.required' => 'Nama harus diisi',
        'nrp_nip.min' => 'Gunakan NRP / NIP lengkap',
        'nrp_nip.max' => 'NRP / NIP terlalu panjang, silahkan coba lagi',
        'user_phone_number.required' => 'Nomor Telepon Dibutuhkan',
        'user_phone_number.numeric' => 'Nomor Telepon harus berupa angka',
        'email.required' => 'Email Dibutuhkan',
        'email.email' => 'Email harus menggunakan format email yang benar',
        'new_password.confirmed' => 'Password baru tidak sesuai'
      ]);
    }

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
      $this->update_validator($request)->validate();

    	$user = User::find($user_id);
      $user->user_name = $request->user_name;
      $user->email = $request->email;
      $user->nrp_nip = $request->nrp_nip;
      $user->user_phone_number = $request->user_phone_number;
    	if ($request->new_password != null){
    		$user->password = bcrypt($request->new_password);
    	}
    	$user->save();

    	return redirect('/staff')->with('message', 'Berhasil update data');
    }

    public function store(Request $request){
      $this->create_validator($request)->validate();

      $data = $request;
      $data->password = bcrypt($request->password);
      User::create($data->toArray());

      return redirect('/staff')->with('message', 'Berhasil menambahkan staff');
    }
}
