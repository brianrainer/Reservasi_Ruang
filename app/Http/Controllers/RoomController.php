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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
