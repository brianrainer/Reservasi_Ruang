<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Room;
use App\User;

class RoomController extends Controller
{
    public function index()
    {
        $data['rooms'] = Room::orderBy('rooms.room_code')->get();
        return $this->view_index($data);
    }

    public function index_create(){
      $data['technicians'] = $this->get_all_room_technician();
      return $this->view_create($data);
    }

    public function index_room_detail($room_code){
        $data['room'] = $this->get_room_by_code($room_code);
        $data['technicians'] = $this->get_room_technician($room_code);
        return $this->view_room($data); 
    }

    public function index_edit($room_id){
        $data['room'] = $this->get_room_by_id($room_id);
        $data['technicians'] = $this->get_all_room_technician();
        return $this->view_edit($data);
    }

    private function view_index($data){
      return view('room.index', $data);
    }

    private function view_room($data){
        return view('room.detail', $data);    
    }

    private function view_edit($data){
        return view('room.edit', $data);
    }

    private function view_create($data){
      return view('room.create', $data);
    }

    protected function validator(Request $request){
        return Validator::make($request->all(), [
          'room_code' => 'required|string|unique:rooms|max:10',
          'room_name' => 'required|string|max:100',
          'room_imagepath' => 'nullable|file|max:5000',
          'tech' => 'nullable|array',
        ], [
          'room_code.required' => 'Kode Ruangan Diperlukan',
          'room_name.required' => 'Deskripsi Ruangan Diperlukan',
          'room_code.max' => 'Kode Ruangan Terlalu Panjang, Maksimal 10 Karakter',
          'room_code.unique' => 'Kode Ruangan Harus Unik',
          'room_name.max' => 'Deskripsi Ruangan Terlalu Panjang, Maksimal 100 Karakter',
          'room_imagepath' => 'Ukuran Gambar terlalu besar, Maksimal 5MB'
        ]);
    }

    protected function validator_technicians(Request $request){
      return Validator::make($request->all(),[
        'tech' => 'required|array'
      ], [
        'tech.required' => 'Teknisi per ruangan Dibutuhkan'
      ]);
    }

    public function create(Request $request)
    {
      $this->validator($request)->validate();
      $this->validator_technicians($request)->validate();

      $room = new Room();
      $room->room_code = $request['room_code'];
      $room->room_name = $request['room_name']; 
      if ($request->hasFile('room_imagepath') && $request->file('room_imagepath')->isValid()) {
        $image = $request->file('room_imagepath');
        $image_name = time().'-'.$image->getClientOriginalName();
        $image->storeAs('public/images', $image_name);
        $room->room_imagepath = 'storage/images/'.$image_name;
      }
      $room->save();

      if (!empty($request->tech)) {
        foreach ($request->tech as $key => $value) {
          $room->addTechnician($value);
        }
      }
      return redirect('room/detail/'.$room->room_code)->with('message', 'Berhasil menambah ruangan');
    }

    public function edit(Request $request, $room_id)
    {
      $this->validator($request)->validate();

      $room = Room::find($room_id);
      $room->room_code = $request['room_code'];
      $room->room_name = $request['room_name'];
      if ($request->hasFile('room_imagepath') && $request->file('room_imagepath')->isValid()){
          $image = $request->file('room_imagepath');
          $image_name = time().'-'.$image->getClientOriginalName();
          $image->storeAs('public/images', $image_name);
          $room->room_imagepath = 'storage/images/'.$image_name;
      }
      $room->save();

      if (!empty($request->tech)) {
        $this->delete_room_technician($room_id);
        foreach ($request->tech as $key => $value) {
          $room->addTechnician($value);
        }
      }
      return redirect('room/detail/'.$room->room_code)->with('message', 'Berhasil mengubah detail ruangan');
    }
    
    protected function get_room_by_id($room_id){
        return Room::where('rooms.id', $room_id)
            ->select(
                'rooms.id as room_id'
                ,'rooms.room_code'
                ,'rooms.room_name'
                ,'rooms.room_imagepath'
                )
            ->first();    
    }

    protected function get_room_by_code($room_code){
        return Room::where('rooms.room_code', $room_code)
            ->select(
                'rooms.id as room_id'
                ,'rooms.room_code'
                ,'rooms.room_name'
                ,'rooms.room_imagepath'
                )
            ->first();
    }

    protected function get_all_room_technician(){
      return User::join('users_roles', 'users.id','=','users_roles.user_id')
          ->join('roles', 'roles.id','=','users_roles.role_id')
          ->where('roles.role_name', 'manage_room')
          ->select(
              'users.id'
              ,'users.user_name as name'
              ,'users.user_phone_number as phone'
            )
          ->distinct()
          ->get();
    }

    protected function get_room_technician($room_code){
      return Room::where('rooms.room_code', $room_code)
          ->join('rooms_technicians','rooms.id','=','rooms_technicians.room_id')
          ->join('users', 'users.id','=','rooms_technicians.user_id')
          ->select(
              'users.id'
              ,'users.user_name as name'
              ,'users.user_phone_number as phone'
            )
          ->distinct()
          ->get();
    }

    protected function delete_room_technician($room_id){
      return DB::table('rooms_technicians')
        ->where('rooms_technicians.room_id', $room_id)
        ->delete();
    }
}
