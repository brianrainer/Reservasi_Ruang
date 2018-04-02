<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rooms;
use App\Bookings;
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
        $rooms = Rooms::all();
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

        $dt = DateTime::createFromFormat('Y/m/d H:i', $request->start_date_submit." ".$request->start_time);
        $booking = new Bookings;
        $booking->name = $request->name;
        $booking->phone_number = $request->phone_number;
        $booking->email = $request->email;
        $booking->room = $request->room;
        $booking->start = $dt;
        $booking->duration = $request->duration;
        $booking->routine = $request->routine;
        $booking->howmanytimes = $request->howmanytimes;
        $booking->agencies = $request->agencies;
        $booking->category = $request->category;
        $booking->event_title = $request->title;
        $booking->event_desc = $request->event_desc;
        $booking->accept = 0;
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
