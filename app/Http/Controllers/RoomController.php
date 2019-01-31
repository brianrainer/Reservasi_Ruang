<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Room;
use App\User;

class RoomController extends Controller
{
    public function index()
    {
        $data['rooms'] = Room::orderBy('rooms.room_code')->paginate(10);
        return view('room.index', $data);
    }

    public function index_create(){
      $data['technicians'] = $this->get_all_room_technician();
      return view('room.create', $data);
    }

    public function index_room_detail($room_code){
        $data['room'] = $this->get_room_by_code($room_code);
        $data['technicians'] = $this->get_room_technician($room_code);
        return view('room.detail', $data);
    }

    public function index_edit($room_id){
        $data['room'] = $this->get_room_by_id($room_id);
        $data['technicians'] = $this->get_all_room_technician();
        return view('room.edit', $data);
    }

    protected function validator_create(Request $request){
        return Validator::make($request->all(), [
          'room_code' => 'required|string|unique:rooms|max:10',
          'room_name' => 'required|string|max:100',
          'room_imagepath' => 'nullable|file|max:5000',
          'tech' => 'required|array',
        ], [
          'room_code.required' => 'Kode Ruangan Diperlukan',
          'room_name.required' => 'Deskripsi Ruangan Diperlukan',
          'room_code.max' => 'Kode Ruangan Terlalu Panjang, Maksimal 10 Karakter',
          'room_code.unique' => 'Kode Ruangan Harus Unik',
          'room_name.max' => 'Deskripsi Ruangan Terlalu Panjang, Maksimal 100 Karakter',
          'room_imagepath' => 'Ukuran Gambar terlalu besar, Maksimal 5MB',
          'tech.required' => 'Teknisi per ruangan Dibutuhkan'
        ]);
    }

    protected function validator_edit(Request $request, $room_id){
      return Validator::make($request->all(), [
        'room_code' => [
          'required', 'string', 'max:10',
          Rule::unique('rooms')->ignore($room_id),
        ],
        'room_name' => 'required|string|max:100',
        'room_imagepath' => 'nullable|file|max:5000',
        'tech' => 'sometimes|array',
      ], [
        'room_code.required' => 'Kode Ruangan Diperlukan',
        'room_name.required' => 'Deskripsi Ruangan Diperlukan',
        'room_code.max' => 'Kode Ruangan Terlalu Panjang, Maksimal 10 Karakter',
        'room_code.unique' => 'Kode Ruangan Harus Unik',
        'room_name.max' => 'Deskripsi Ruangan Terlalu Panjang, Maksimal 100 Karakter',
        'room_imagepath' => 'Ukuran Gambar terlalu besar, Maksimal 5MB'
      ]);
    }

    public function create(Request $request)
    {
      $this->validator_create($request)->validate();

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
      $this->validator_edit($request, $room_id)->validate();

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

    public function delete(Request $request)
    {
      $room = Room::find($request->room_id);
      if (!is_null($room->bookingDetail())) {
        $room->bookingDetail()->delete();
      }
      $room->delete();

      return redirect('room')->with('message', 'Berhasil menghapus ruangan');
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
      return User::select(
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
