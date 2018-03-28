<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;
use Session;
use Redirect;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()    
    {
        //
        $rooms = DB::table('rooms')->get();
        return view('form',$rooms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check error in request entry
        $request->validate([
            'name'          => 'required',
            'phone_number'  => 'required|numeric',
            'email'         => 'required|email',
            'title'         => 'required',
            'room'          => 'required',
            'agencies'      => 'required',
            'start_date'    => 'required',
            'start_time'    => 'required',
            'duration'      => 'required|numeric',
            'routine'       => 'required',
            'howmanytimes'  => 'required|numeric',
            'category'      => 'required',
            'event_desc'    => 'required',
        ]);

        //store data
        // $timestamp = \Carbon\Carbon::createFromFormat('Y/m/d H:m', $request->start_date." ".$request->start_time)->timestamp;
        // dd($timestamp);
        $dt = DateTime::createFromFormat('Y/m/d H:m', $request->start_date." ".$request->start_time);
        DB::table('bookings')->insert([
            'name'          => $request->name,
            'phone_number'  => $request->phone_number,
            'email'         => $request->email,
            'room'          => $request->room,
            'start'         => $dt,
            'duration'      => $request->duration,
            'routine'       => $request->routine,
            'howmanytimes'  => $request->howmanytimes,
            'agencies'      => $request->agencies,
            'category'      => $request->category,
            'event_desc'    => $request->event_desc,
            'accept'        => 0
        ]);

        //redirect
        Session::flash('message', 'Reservasi berhasil~~ Kalau udah disetujui bakal diberitahu di email ya~');
        return Redirect::to('/room');
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
        $booking = bookings::findOrFail($id);
        $booking->delete();
        Session::flash('message', 'Booking berhasil dihapus~');
        return Redirect::to('/bookings');
    }

}
