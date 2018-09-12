<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class RoomController extends Controller
{
    protected $mushola = 'Mushola';
    protected $ruang_kelas = 'Ruang Kelas';
    protected $ruang_rapat = 'Ruang TV / Rapat';
    protected $ruang_dosen = 'Ruang Dosen';
    protected $laboratorium = 'Laboratorium';
    protected $aula = 'Aula';
    protected $pikti = 'PIKTI';
    protected $perpustakaan = 'Perpustakaan Informatika / RBTC';
    protected $hmtc = 'Ruang Himpunan Teknik Informatika';
    protected $ruang_sidang = 'Ruang Sidang';
    protected $akademik = 'Bagian Akademik';
    protected $kemahasiswaan = 'Bagian Kemahasiswaan dan Kepegawaian';
    protected $ketua_pasca = 'Ruang Ketua Pasca Sarjana';
    protected $sekret_pasca = 'Ruang Sekretaris Pasca Sarjana';

    protected $bisa_dipinjam = [
      'IF-101',
      'IF-102',
      'IF-103',
      'IF-104',
      'IF-105A',
      'IF-105B',
      'IF-106',
      'IF-108',
      'IF-111',
      'IF-112',
      'AULA',
      'IF-304',
      'IF-308'
    ];

    protected $hanya_dosen = [
      'SIDANG',
      'IF-215B',
      'IF-217',
      'IF-221'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['class_rooms'] = Room::where('rooms.room_name','Ruang Kelas')
            ->orderBy('rooms.room_code')
            ->get();
        $data['teachers_rooms'] = Room::where('rooms.room_name','Ruang Dosen')
            ->orderBy('rooms.room_code')
            ->get();
        $data['other_rooms'] = Room::where('rooms.room_name','<>','Ruang Kelas')
            ->where('rooms.room_name','<>','Ruang Dosen')
            ->orderBy('rooms.room_code')
            ->get();
        return view('room.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit(Request $request, $room_id)
    {
        // $this->validator($request)->validate();
        // dd($request);

        $room = Room::find($room_id);
        $room->room_code = $request['room_code'];
        $room->room_name = $request['room_name'];
        if ($request->hasFile('room_imagepath') && $request->file('room_imagepath')->isValid()){
            $image = $request->file('room_imagepath');
            $image_name = time().'-'.$image->getClientOriginalName();
            $image->storeAs('public/images',$image_name);
            $room->room_imagepath = 'storage/images/'.$image_name;
        }
        $room->save();

        return redirect('room');
    }

    protected function validator(Request $request){
        return new Validator(); // TODO
    }

    public function index_room_detail($room_code){
        $data['room'] = $this->get_room_by_code($room_code)[0];
        return $this->view_room($data); 
    }

    public function index_edit($room_id){
        $data['room'] = $this->get_room_by_id($room_id)[0];
        return $this->view_edit($data);
    }

    protected function view_room($data){
        return view('room.detail', $data);    
    }

    protected function view_edit($data){
        return view('room.edit', $data);
    }

    protected function get_room_by_id($room_id){
        return Room::where('rooms.id', $room_id)
            ->join('rooms_technicians', 'rooms_technicians.room_id','=','rooms.id')
            ->join('users','users.id','=','rooms_technicians.user_id')
            ->select(
                'rooms.id as room_id'
                ,'rooms.room_code'
                ,'rooms.room_name'
                ,'rooms.room_imagepath'
                ,'users.user_name as technician'
                ,'users.user_phone_number as phone'
                )
            ->get();    
    }

    protected function get_room_by_code($room_code){
        return Room::where('rooms.room_code', $room_code)
            ->join('rooms_technicians', 'rooms_technicians.room_id','=','rooms.id')
            ->join('users','users.id','=','rooms_technicians.user_id')
            ->select(
                'rooms.id as room_id'
                ,'rooms.room_code'
                ,'rooms.room_name'
                ,'rooms.room_imagepath'
                ,'users.user_name as technician'
                ,'users.user_phone_number as phone'
                )
            ->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
