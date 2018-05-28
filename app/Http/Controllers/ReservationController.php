<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Room;
use App\Agency;
use App\Category;
use App\Routine;
use App\BookingDetail;
use App\Booking;
use DateTime;
use Session;
use Redirect;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reserve.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()    
    {
        //
        $rooms = Room::all();
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

    /**
     * Helper Functions - Load variables for 4 reservation forms (once, multionce, repeat, multirepeat)
     * @return array
     */
    protected function reserve_load(){
        $data['rooms'] = Room::all();
        $data['routines'] = Routine::all();
        $data['agencies'] = Agency::all();
        $data['categories'] = Category::all();
        return $data;
    }

    /**
     * Helper Functions - Main Validator for Reservation Forms
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Support\Facades\Validator
     */    
    public function validator(Request $request){
        return Validator::make($request->all(), [
            'full_name' => 'required|string|max:100',
            'nrp_nip' => 'nullable|string|min:10|max:20',
            'phone_number' => 'required',
            'email' => 'required|email|max:100',
            'agency' => 'required|numeric',
            'start_date' => 'required|date|after:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'routine' => 'required|numeric',
            'howmanytimes' => 'required|numeric|min:1|max:20',
            'title' => 'required|string|max:140',
            'category' => 'required|numeric',
            'event_description' => 'required|string|max:180',
            'agree' => 'required|filled',
        ], [
            'full_name.required' => 'Nama Lengkap Dibutuhkan',
            'nrp_nip.min' => 'Gunakan NRP / NIP lengkap',
            'nrp_nip.max' => 'NRP / NIP terlalu panjang, silahkan coba lagi',
            'phone_number.required' => 'Nomor Telepon Dibutuhkan',
            'email.required' => 'Email Dibutuhkan',
            'email.email' => 'Email harus menggunakan format email yang benar',
            'email.max' => 'Email terlalu panjang, gunakan email di bawah 100 karakter',
            'agency.required' => 'Organisasi Dibutuhkan',
            'agency.numeric' => 'Organisasi yang diwakilkan tidak valid',
            'start_date.required' => 'Tanggal Reservasi Dibutuhkan',
            'start_date.date' => 'Tanggal Reservasi harus menggunakan format tanggal yang benar',
            'start_date.after' => 'Reservasi dapat dilakukan maksimal satu hari sebelum kegiatan',
            'start_time.required' => 'Waktu Mulai Dibutuhkan',
            'end_time.required' => 'Waktu Selesai Dibutuhkan',
            'end_time.after' => 'Waktu Selesai harus setelah Waktu Mulai',
            'routine.required' => 'Tipe Jeda Rutinitas Kegiatan Dibutuhkan',
            'routine.numeric' => 'Tipe Jeda Rutinitas Kegiatan Tidak Valid',
            'howmanytimes.required' => 'Banyak Perulangan Kegiatan Dibutuhkan',
            'howmanytimes.numeric' => 'Banyak Perulangan Kegiatan harus berupa angka',
            'howmanytimes.min' => 'Banyak Perulangan Kegiatan Minimum adalah Sekali (1x)',
            'howmanytimes.max' => 'Banyak Perulangan Kegiatan Maximum adalah Dua Puluh Kali (20x)',
            'title.required' => 'Judul Kegiatan Diperlukan',
            'title.string' => 'Judul Kegiatan harus berupa String',
            'title.max' => 'Maximal Judul Kegiatan adalah 140 Karakter',
            'category.required' => 'Kategori Kegiatan Dibutuhkan',
            'category.numeric' => 'Kategori Kegiatan Tidak Valid',
            'event_description.required' => 'Deskripsi Kegiatan Dibutuhkan',
            'event_description.max' => 'Maximal Deskripsi Kegiatan adalah 180 Karakter',
            'agree.required' => 'Persetujuan Diperlukan',
            'agree.filled' => 'Anda Harus Setuju dengan Syarat dan Ketentuan Reservasi',
        ]);
    }

    /**
     * Helper Functions - Room Validator
     * @param  \Illuminate\Http\Request $request
     * @param  Boolean $is_array
     * @return \Illuminate\Support\Facades\Validator
     */
    public function room_validator(Request $request, $is_array){
        if ($is_array) {
            return Validator::make($request->all(), [
                'room' => 'required|array',
                'room.*' => 'numeric',
            ], [
                'room.required' => 'Ruangan Harus Dipilih',
                'room.array' => 'Ruangan Harus Berupa Array',
                'room.*.numeric' => 'Ruangan Tidak Valid',
            ]);
        } else {
            return Validator::make($request->all(), [
                'room' => 'required|numeric',
            ], [                
                'room.required' => 'Ruangan Harus Dipilih',
                'room.numeric' => 'Ruangan Tidak Valid',
            ]);
        }
    }

    /**
     * Helper Functions - Create Booking
     * @param  \Illuminate\Http\Request $request
     * @return \App\Booking
     */
    protected function create_booking(Request $request){
        return Booking::create([
            'name' => $request->full_name,
            'nrp_nip' => $request->nrp_nip,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'agency_id' => $request->agency,
            'event_title' => $request->title,
            'event_description' => $request->event_description,
            'category_id' => $request->category,            
        ]);
    }

    /**
     * Helper Functions - Create Booking Detail
     * @param  Integer $room_id
     * @param  Integer $booking_id
     * @param  String $start_time
     * @param  String $end_time
     * @return App\BookingDetail
     */
    protected function create_booking_detail($room_id, $booking_id, String $start_time, String $end_time){
        return BookingDetail::create([
            'booking_id' => $booking_id,
            'room_id' => $room_id,
            'event_start' => $start_time,
            'event_end' => $end_time,
            'booking_status_id' => '1',
        ]);
    }

    /**
     * Helper Functions - Check Booking Crash
     */
    public function check_booking(){
        // $data['bookings'] = 
        //     Booking::join('booking_details', 'booking_details.booking_id','=','bookings.id')
        //     ->join('agencies', 'agencies.id','=','bookings.agency_id')
        //     ->join('categories', 'categories.id','=','bookings.category_id')
        //     ->join('rooms', 'rooms.id','=','booking_details.room_id')
        //     ->join('booking_statuses', 'booking_statuses.id','=','booking_details.booking_status_id')
        //     ->get();
        $data['bookings'] = 
            Booking::join('agencies', 'agencies.id','=','bookings.agency_id')
            ->join('categories', 'categories.id','=','bookings.category_id')
            ->get();
        return view('reserve.status', $data); 
    }

    // to do : helper search, filter by organization, category, agency, status, etc. status approval
    // to do : calendar view with fullcalendar.io
    // to do : middleware / auth separation

    public function terms(){
        return view('terms');
    }

    public function once_index(){
        return view('reserve.once', $this->reserve_load());
    }

    public function once(Request $request){
        $this->validator($request)->validate();
        $this->room_validator($request, false)->validate();

        $booking = $this->create_booking($request);

        $start_time = new Carbon($request->start_date." ".$request->start_time);
        $end_time = new Carbon($request->start_date." ".$request->end_time);
        
        $bookingDetail = $this->create_booking_detail(
            $request->room, 
            $booking->id, 
            $start_time->toDateTimeString(), 
            $end_time->toDateTimeString()
        );

        $data = $this->reserve_load();
        $data['status'] = 'Berhasil Mengajukan Reservasi #'.$booking->id;
        return view('reserve.once', $data);
    }

    public function repeat_index(){
        return view('reserve.repeat', $this->reserve_load());
    }

    public function repeat(Request $request){
        $this->room_validator($request, false)->validate();
        $this->validator($request)->validate();

        $booking = $this->create_booking($request);

        $start_time = new Carbon($request->start_date." ".$request->start_time);
        $end_time = new Carbon($request->start_date." ".$request->end_time);

        $this->create_booking_detail(
            $request->room, 
            $booking->id, 
            $start_time->toDateTimeString(), 
            $end_time->toDateTimeString()
        );
        
        for ($i=1; $i < $request->howmanytimes; $i++) { 
            $this->create_booking_detail(
                $request->room, 
                $booking->id, 
                $start_time->addSeconds($request->routine)->toDateTimeString(), 
                $end_time->addSeconds($request->routine)->toDateTimeString()
            );
        }

        $data = $this->reserve_load();
        $data['status'] = 'Berhasil Mengajukan Reservasi #'.$booking->id;
        return view('reserve.repeat', $data);
    }

    public function multionce_index(){
        return view('reserve.multionce', $this->reserve_load());
    }

    public function multionce(Request $request){
        $this->validator($request)->validate();
        $this->room_validator($request, true)->validate();

        $booking = $this->create_booking($request);

        $start_time = new Carbon($request->start_date." ".$request->start_time);
        $end_time = new Carbon($request->start_date." ".$request->end_time);

        foreach ($request->room as $key => $value) {
            $this->create_booking_detail(
                $value,
                $booking->id,
                $start_time->toDateTimeString(),
                $end_time->toDateTimeString()
            );
        }

        $data = $this->reserve_load();
        $data['status'] = 'Berhasil Mengajukan Reservasi #'.$booking->id;
        return view('reserve.multionce', $data);
    }

    public function multirepeat_index(){
        return view('reserve.multirepeat', $this->reserve_load());
    }

    public function multirepeat(Request $request){
        $this->room_validator($request, true)->validate();
        $this->validator($request)->validate();

        $booking = $this->create_booking($request);

        $start_time = new Carbon($request->start_date." ".$request->start_time);
        $end_time = new Carbon($request->start_date." ".$request->end_time);

        foreach ($request->room as $key => $value) {
            $this->create_booking_detail(
                $value,
                $booking->id,
                $start_time->toDateTimeString(),
                $end_time->toDateTimeString()
            );
        }

        for ($i=1; $i < $request->howmanytimes ; $i++) { 
            $start_time->addSeconds($request->routine);
            $end_time->addSeconds($request->routine);
            foreach ($request->room as $key => $value) {
                $this->create_booking_detail(
                    $value,
                    $booking->id,
                    $start_time->toDateTimeString(),
                    $end_time->toDateTimeString()
                );
            }
        }

        $data = $this->reserve_load();
        $data['status'] = 'Berhasil Mengajukan Reservasi #'.$booking->id;
        return view('reserve.multirepeat', $data);
    }
}
