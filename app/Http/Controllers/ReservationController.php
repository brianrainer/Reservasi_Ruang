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
    protected function view_reserve($data){
        return view('reserve.index', $data);
    }

    protected function view_status($data){
        return view('status.status', $data);
    }

    protected function view_detail($data){
        return view('status.detail', $data);
    }

    protected function view_once($data){
        return view('reserve.once', $data);
    }

    protected function view_repeat($data){
        return view('reserve.repeat', $data);
    }

    protected function view_multionce($data){
        return view('reserve.multionce', $data);
    }

    protected function view_multirepeat($data){
        return view('reserve.multirepeat', $data);
    }

    protected function view_welcome($data){
        return view('welcome', $data);
    }

    protected function view_calendar($data){
        return view('calendar', $data);
    }

    protected function view_terms($data){
        return view('terms', $data);
    }

    /**
     * Helper Functions for Loading Variables
     * @return array
     */
    protected function load_reserve_form(){
        $data['rooms'] = Room::all();
        $data['routines'] = Routine::all();
        $data['agencies'] = Agency::all();
        $data['categories'] = Category::all();
        return $data;
    }
    
    protected function load_booking(){
        $data['bookings'] = $this->get_all_booking(); 
        return $data; 
    }

    protected function load_booking_detail($booking_id){
        $data['booking'] = $this->get_one_booking($booking_id)[0];
        $data['booking_details'] = $this->get_all_detail($booking_id); 
        return $data;
    }


    /**
     * Helper Functions - Main Validator for Reservation Forms
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Support\Facades\Validator
     */    
    protected function validator_form(Request $request){
        return Validator::make($request->all(), [
            'full_name' => 'required|string|max:100',
            'nrp_nip' => 'nullable|string|min:10|max:20',
            'phone_number' => 'required',
            'email' => 'required|email|max:100',
            'agency' => 'required|numeric',
            // 'start_date' => 'required|date|after:today',
            'start_date' => 'required|date',
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
    protected function validator_room(Request $request, $is_array){
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

    protected function validator_booking(Request $request){
        return Validator::make($request->all(), [
            'booking_id' => 'required|numeric',
        ], [
            'booking_id.required' => 'Nomor Reservasi Diperlukan',
            'booking_id.numeric' => 'Nomor Reservasi Tidak Valid',
        ]);        
    }

    protected function validator_detail(Request $request){
        return Validator::make($request->all(), [
            'booking_id' => 'required|numeric',
            'detail_id' => 'required|numeric',
        ], [
            'booking_id.required' => 'Nomor Reservasi Diperlukan',
            'booking_id.numeric' => 'Nomor Reservasi Tidak Valid',
            'detail_id.required' => 'Nomor Detail Reservasi Diperlukan',
            'detail_id.numeric' => 'Nomor Detail Reservasi Tidak Valid',
        ]);
    }



    public function index_reserve(){
        return $this->view_reserve([]);
    }

    public function index_welcome(){
        $data['bookings'] = $this->get_all_booking_today();
        return $this->view_welcome($data);
    }

    public function index_calendar(){
        return $this->view_calendar([]);
    }

    public function index_status(){
        return $this->view_status($this->load_booking());
    }

    public function index_detail($booking_id){
        return $this->view_detail($this->load_booking_detail($booking_id));
    }

    public function index_terms(){
        return $this->view_terms([]);
    }

    public function index_once(){
        return $this->view_once($this->load_reserve_form());
    }

    public function index_repeat(){
        return $this->view_repeat($this->load_reserve_form());
    }

    public function index_multi_once(){
        return $this->view_multionce($this->load_reserve_form());
    }
    
    public function index_multi_repeat(){
        return $this->view_multirepeat($this->load_reserve_form());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()    
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
    protected function get_all_booking(){
        return Booking::join('agencies', 'agencies.id','=','bookings.agency_id')
            ->join('categories', 'categories.id','=','bookings.category_id')
            ->select(
                'bookings.id',
                'bookings.name',
                'bookings.event_title',
                'bookings.created_at',
                'agencies.agency_name',
                'categories.category_name'
                )
            ->orderBy('bookings.created_at', 'DESC')
            ->get();
    }

    protected function get_all_booking_today(){
        return Booking::join('booking_details', 'booking_details.booking_id','=','bookings.id')
            ->join('rooms', 'booking_details.room_id','=','rooms.id')
            // ->join('booking_statuses', 'booking_details.booking_status_id','=','booking_statuses.id')
            ->where('booking_details.event_start', '>=', Carbon::today())
            ->where('booking_details.event_end', '<=', Carbon::tomorrow())           
            // ->where('booking_statuses.id','=','2')
            ->select(
                'bookings.id', 
                'bookings.event_title', 
                'rooms.room_code',
                'rooms.room_name',
                // 'booking_statuses.booking_status_name',
                'booking_details.event_start',
                'booking_details.event_end'
                )
            ->get();
    }

    protected function get_one_booking($booking_id){
        return Booking::where('bookings.id', $booking_id)
            ->join('agencies', 'agencies.id','=','bookings.agency_id')
            ->join('categories', 'categories.id','=','bookings.category_id')
            ->select(
                'bookings.id',
                'bookings.name',
                'bookings.nrp_nip',
                'bookings.email',
                'bookings.phone_number',
                'bookings.event_title',
                'bookings.event_description',
                'agencies.agency_name',
                'categories.category_name'
                )
            ->get();        
    }

    protected function get_one_detail($detail_id){
        return BookingDetail::where('booking_details.id', $detail_id)
            ->join('rooms', 'rooms.id','=','booking_details.room_id')
            ->join('booking_statuses', 'booking_statuses.id','=','booking_details.booking_status_id')
            ->select(
                'booking_details.id',
                'booking_details.event_start',
                'booking_details.event_end',
                'rooms.id as room_id',
                'rooms.room_code',
                'rooms.room_name',
                'booking_statuses.booking_status_name'
                )
            ->get();
        
    }

    protected function get_all_detail($booking_id){
        return Booking::where('bookings.id', $booking_id)
            ->join('booking_details', 'booking_details.booking_id','=','bookings.id')
            ->join('rooms', 'rooms.id','=','booking_details.room_id')
            ->join('booking_statuses', 'booking_statuses.id','=','booking_details.booking_status_id')
            ->select(
                'booking_details.id',
                'booking_details.event_start',
                'booking_details.event_end',
                'rooms.id as room_id',
                'rooms.room_code',
                'rooms.room_name',
                'booking_statuses.booking_status_name'
                )
            ->get();
    }

    protected function set_detail($detail_id, $status_id){
        $booking_detail = BookingDetail::findOrFail($detail_id);
        $booking_detail->booking_status_id = $status_id;
        return $booking_detail->save();
    }

    protected function accept_detail($detail_id){
        return $this->set_detail($detail_id, 2);
    }
    protected function reject_detail($detail_id){
        return $this->set_detail($detail_id, 3);
    }

    public function check_crash($detail_id, $room_id, $event_start, $event_end){
        return BookingDetail::join('rooms', 'rooms.id','=','booking_details.room_id')
            // ->join('booking_statuses', 'booking_statuses.id','=','booking_details.booking_status_id')
            ->where(function($query) use ($detail_id, $room_id, $event_start, $event_end){
                    $query
                    ->where('booking_details.id', '<>', $detail_id)
                    ->where('rooms.id', '=', $room_id)
                    // ->where('booking_status.id', '=', '2')
                    ->where('booking_details.event_start','>=', $event_start)
                    ->where('booking_details.event_start', '<=', $event_end);
                })
            ->orWhere(function($query)  use ($detail_id, $room_id,$event_start, $event_end){
                    $query
                    ->where('booking_details.id', '<>', $detail_id)
                    ->where('rooms.id', '=', $room_id)
                    // ->where('booking_status.id', '=', '2')
                    ->where('booking_details.event_end','>=', $event_start)
                    ->where('booking_details.event_end', '<=', $event_end);
                })
            ->orWhere(function($query)  use ($detail_id, $room_id,$event_start, $event_end){
                    $query
                    ->where('booking_details.id', '<>', $detail_id)
                    ->where('rooms.id', '=', $room_id)
                    // ->where('booking_status.id', '=', '2')
                    ->where('booking_details.event_start','<=', $event_start)
                    ->where('booking_details.event_end', '>=', $event_end);
                })
            ->select(
                'booking_details.id',
                'booking_details.event_start',
                'booking_details.event_end'
                )
            ->get();
    }

    public function accept_all_reservation(Request $request){
        $this->validator_booking($request)->validate();

        $bookings = $this->get_all_detail($request->booking_id);

        foreach ($bookings as $booking_detail) {
            if ( $this->check_crash(
                    $booking_detail->id,
                    $booking_detail->room_id,
                    $booking_detail->event_start,
                    $booking_detail->event_end
                )->count() ) {
                // pake flag ?

            } else {
                $this->accept_detail($booking_detail->id);
            }
        }

        $data = $this->load_booking();
        $data['status'] = 'Berhasil Menerima Reservasi #'.$request->booking_id;
        return $this->view_status($data);
    }

    public function reject_all_reservation(Request $request){
        $this->validator_booking($request)->validate();

        $bookings = $this->get_all_detail($request->booking_id);

        foreach ($bookings as $booking_detail) {
            $this->reject_detail($booking_detail->id);
        }

        $data = $this->load_booking();
        $data['status'] = 'Berhasil Menolak Reservasi #'.$request->booking_id;
        return $this->view_status($data);
    }

    public function accept_one_reservation(Request $request){
        $this->validator_detail($request)->validate();

        $booking_detail = $this->get_one_detail($request->detail_id)[0];

        if ( $this->check_crash(
                $request->detail_id,
                $booking_detail->room_id, 
                $booking_detail->event_start, 
                $booking_detail->event_end
            )->count() ){
            $data = $this->load_booking_detail($request->booking_id);
            $data['error'] = 'Gagal Menerima Detail Reservasi #'.$request->detail_id." karena Bentrok";
        } else {
            $this->accept_detail($request->detail_id);
            $data = $this->load_booking_detail($request->booking_id);
            $data['status'] = 'Berhasil Menerima Detail Reservasi #'.$request->detail_id;
        }
        return $this->view_detail($data);
    }

    public function reject_one_reservation(Request $request){
        $this->validator_detail($request)->validate();
        $this->reject_detail($request->detail_id);
        $data = $this->load_booking_detail($request->booking_id);
        $data['status'] = 'Berhasil Menolak Detail Reservasi #'.$request->detail_id;
        return $this->view_detail($data);
    }

    // to do : helper search, filter by organization, category, agency, status, etc. status approval
    // to do : calendar view with fullcalendar.io
    // to do : middleware / auth separation

    public function once(Request $request){
        $this->validator_form($request)->validate();
        $this->validator_room($request, false)->validate();

        $booking = $this->create_booking($request);

        $start_time = new Carbon($request->start_date." ".$request->start_time);
        $end_time = new Carbon($request->start_date." ".$request->end_time);
        
        $bookingDetail = $this->create_booking_detail(
            $request->room, 
            $booking->id, 
            $start_time->toDateTimeString(), 
            $end_time->toDateTimeString()
        );

        $data = $this->load_reserve_form();
        $data['status'] = 'Berhasil Mengajukan Reservasi #'.$booking->id;
        return $this->view_once($data);
    }

    public function repeat(Request $request){
        $this->validator_room($request, false)->validate();
        $this->validator_form($request)->validate();

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

        $data = $this->load_reserve_form();
        $data['status'] = 'Berhasil Mengajukan Reservasi #'.$booking->id;
        return $this->view_repeat($data);
    }


    public function multionce(Request $request){
        $this->validator_form($request)->validate();
        $this->validator_room($request, true)->validate();

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

        $data = $this->load_reserve_form();
        $data['status'] = 'Berhasil Mengajukan Reservasi #'.$booking->id;
        return $this->view_multionce($data);
    }

    public function multirepeat(Request $request){
        $this->validator_room($request, true)->validate();
        $this->validator_form($request)->validate();

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

        $data = $this->load_reserve_form();
        $data['status'] = 'Berhasil Mengajukan Reservasi #'.$booking->id;
        return $this->view_multirepeat($data);
    }
}
