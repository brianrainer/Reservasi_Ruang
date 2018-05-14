<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bookings;
use App\Schedules;
use Session;
use Redirect;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bookings = Bookings::paginate(3);
        return view('booklist', ['bookings'=>$bookings]);
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
    public function accept(Request $request, $id)
    {
        $booking = Bookings::findOrFail($id);

        //checking schedules data 
        if ($booking->routine = 'Daily')
            $interval = new DateInterval('P1D');
        elseif ($booking->routine = 'Weekly')
            $interval = new DateInterval('P7D');
        elseif ($booking->routine = 'Biweekly')
            $interval = new DateInterval('P14D');
        else
            $interval = new DateInterval('P1M');
        $starttime = $booking->start;
        $endtime = $booking->start->add(new DateInterval('PT'.$booking->duration.'M'));
        $tstarttime = $startime;
        $tendtime = $endtime;
        for ($i=0; $i < $booking->howmanytimes; $i++) {
            if(schedules::where('start','>=',$tstarttime,'and','end','<=',$tendtime)->where('start','<=',$tstarttime,'and','end','<=',$tendtime)->
                where('start','>=',$tstarttime,'and','end','>=',$tendtime)->
                where('start','<=',$tstarttime,'and','end','>=',$tendtime)->
                exist()){

                Session::flash('message', 'Reservasi ditolak, terdapat jadwal yang bertabrakan');
                return Redirect::to('/booklist');
            }
            $tstarttime->add($interval);
            $tendtime->add($interval);
        }

        //insert schedule(s) data
        $booking->accept = 1;
        $booking->save();
        for ($i=0; $i < $booking->howmanytimes; $i++){
            $schedule = new Schedules;
            $schedule->booking_id = $booking->booking_id;
            $schedule->room_id = $booking->room_id;
            $schedule->start = $starttime;
            $schedule->end = $endtime;
            $schedule->save();

            $starttime->add($interval);
            $endtime->add($interval);
        }
        Session::flash('message', 'Reservasi diterima, jadwal berhasil dimasukkan');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reject($id)
    {
        //
        $booking = bookings::findOrFail($id);
        $booking->delete();
    }
}
