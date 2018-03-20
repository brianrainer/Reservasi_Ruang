<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
        return view('form');
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
            'agency'        => 'required',
            'start_date'    => 'required',
            'start_time'    => 'required',
            'duration'      => 'required|numeric',
            'routine'       => 'required',
            'howmanytimes'  => 'required|numeric',
            'category'      => 'required',
            'event_desc'    => 'required',
        ]);

        //store data
        $booking = new bookings;
        $booking->name = $request->name;
        $booking->phone_number = $request->phone_number;
        $booking->email = $request->email;
        $booking->room = $request->room;
        $booking->start = $request->start;
        $booking->end = $request->end;
        $booking->agency = $request->routine;
        $booking->event_desc = $request->event_desc;
        $booking->save();

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
    }
}
