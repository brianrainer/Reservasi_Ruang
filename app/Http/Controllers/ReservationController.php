<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Room;
use App\Agency;
use App\Category;
use App\Routine;
use App\BookingDetail;
use App\Booking;
use App\Mail\BookingNotification;
use DateTime;
use Session;
use Redirect;
use Carbon\Carbon;
use DB;
use PDF;
use File;

class ReservationController extends Controller
{
    protected $waiting_booking_status_id = 1;
    protected $accepted_booking_status_id = 2;
    protected $rejected_booking_status_id = 3;

    public function index_welcome(){
        $data['bookings'] = $this->get_all_booking_today();
        return view('welcome', $data);
    }

    public function index_calendar(){
        return view('calendar');
    }

    public function index_agenda(){
        return view('agenda');
    }

    public function index_room_agenda($room_code){
        $data['room_code'] = $room_code;

        return view('agenda', $data);
    }

    public function index_status(Request $request){
        if($request->kegiatan || $request->status || $request->peminjam) {
          $data['bookings'] = $this->get_booking_by_params($request->peminjam, $request->kegiatan, $request->status);
        }
        else {
          $data['bookings'] = $this->get_all_booking();
        }

        return view('status.status', $data);
    }

    public function index_detail($booking_id){
        $data = $this->load_reserve_form();
        $data['booking'] = $this->get_one_booking($booking_id);
        $data['booking_details'] = $this->get_all_detail_paginate($booking_id); 
        $data['accepted_id'] = $this->accepted_booking_status_id;
        $data['rejected_id'] = $this->rejected_booking_status_id;
        $data['waiting_id'] = $this->waiting_booking_status_id;

        return view('status.detail', $data);
    }

    public function index_multi_repeat(){
        $data = $this->load_reserve_form();
        return view('reserve.multirepeat', $data);
    }

    public function index_edit_reservation($booking_id){
      $data = $this->load_reserve_form();
      $data['booking'] = $this->get_one_booking($booking_id);
      return view('reserve.edit', $data);
    }

    protected function load_reserve_form(){
        $data['rooms'] = Room::all();
        $data['routines'] = Routine::all();
        $data['agencies'] = Agency::all();
        $data['categories'] = Category::all();
        return $data;
    }

    protected function validator_form(Request $request){
        return Validator::make($request->all(), [
            'full_name' => 'required|string',
            'nrp_nip' => 'nullable|string',
            'phone_number' => 'required',
            'email' => 'required|email',
            'agency' => 'required|numeric',  
            'start_date' => 'required|date|after:yesterday',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'routine' => 'required|numeric',
            'howmanytimes' => 'required|numeric|min:1|max:20',
            'title' => 'required|string',
            'category' => 'required|numeric',
            'event_description' => 'required|string',
            'agree' => 'required|filled',
        ], [
            'full_name.required' => 'Nama Lengkap Dibutuhkan',
            'phone_number.required' => 'Nomor Telepon Dibutuhkan',
            'email.required' => 'Email Dibutuhkan',
            'email.email' => 'Email harus menggunakan format email yang benar',
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
            'category.required' => 'Kategori Kegiatan Dibutuhkan',
            'category.numeric' => 'Kategori Kegiatan Tidak Valid',
            'event_description.required' => 'Deskripsi Kegiatan Dibutuhkan',
            'agree.required' => 'Persetujuan Diperlukan',
            'agree.filled' => 'Anda Harus Setuju dengan Syarat dan Ketentuan Reservasi',
        ]);
    }

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

    protected function validator_time(Request $request){
        return Validator::make($request->all(), [
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ], [
            'start_time.required' => 'Waktu Mulai Dibutuhkan',
            'end_time.required' => 'Waktu Selesai Dibutuhkan',
            'end_time.after' => 'Waktu Selesai harus setelah Waktu Mulai',
        ]);
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

    /**
     * Function to generate PDF - API
     */
    protected function download_pdf($booking_id){
      $booking = Booking::find($booking_id);
      $booking_details = $this->get_all_detail($booking_id);
      $pdf_data = $booking_details->reduce(function($carry, $item){
        $start = Carbon::parse($item->event_start);
        $end = Carbon::parse($item->event_end);

        $obj['room'] = $item->room_code;
        $obj['date'] = $start->formatLocalized('%A, %d %B %Y');
        $obj['time'] = $start->format('H:i').' - '.$end->format('H:i');
        $obj['raw_date'] = $start->toDateString();

        return $carry->push((object) $obj);
      }, collect());

      $attachment_data = $pdf_data->unique('raw_date')->reduce(function($carry, $item) {
        $start = Carbon::parse($item->raw_date);
        $end = $start->copy()->addDays(1);

        $other_event = $this->get_all_detail_by_time($start, $end)->reduce(function($carry, $item) {
          $start = Carbon::parse($item->event_start);
          $end = Carbon::parse($item->event_end);
          
          $obj['title'] = $item->event_title;
          $obj['room'] = $item->room_code;
          $obj['description'] = $item->event_description;
          $obj['time'] = $start->format('H:i').' - '.$end->format('H:i');

          return $carry->push((object) $obj);
        }, collect());

        if(!$other_event->isEmpty()){
          return $carry->put($start->formatLocalized("%A, %d %B %Y"), $other_event);
        }

        return $carry;
      }, collect());

      $data['booking_details'] = $pdf_data;
      $data['attachments'] = $attachment_data;
      $data['booking'] = $booking;
      $data['date'] = Carbon::parse($booking->created_at)->formatLocalized('%d %B %Y');
      $data['head_of_informatic'] = "Darlis Herumurti S.Kom.,M.Kom";

      $pdf = PDF::loadView('pdf.main', $data);

      return $pdf->stream('surat_ijin.pdf'); 
    }
    
    /**
     * Function to generate pdf v2 - API
     */
    protected function download_pdf_v2($booking_id){
      $booking = Booking::find($booking_id);
      $booking_details = $this->get_all_detail($booking_id);
      $pdf_data = $booking_details->reduce(function($carry, $item){
        $start = Carbon::parse($item->event_start);
        $end = Carbon::parse($item->event_end);

        $obj['room'] = $item->room_code;
        $obj['date'] = $start->formatLocalized('%A, %d %B %Y');
        $obj['time'] = $start->format('H:i').' - '.$end->format('H:i');
        $obj['raw_date'] = $start->toDateString();

        return $carry->push((object) $obj);
      }, collect());

      $attachment_data = $pdf_data->unique('raw_date')->reduce(function($carry, $item) {
        $start = Carbon::parse($item->raw_date);
        $end = $start->copy()->addDays(1);

        $other_event = $this->get_all_detail_by_time($start, $end)->reduce(function($carry, $item) {
          $start = Carbon::parse($item->event_start);
          $end = Carbon::parse($item->event_end);
          
          $obj['title'] = $item->event_title;
          $obj['room'] = $item->room_code;
          $obj['description'] = $item->event_description;
          $obj['time'] = $start->format('H:i').' - '.$end->format('H:i');

          return $carry->push((object) $obj);
        }, collect());

        if(!$other_event->isEmpty()){
          return $carry->put($start->formatLocalized("%A, %d %B %Y"), $other_event);
        }

        return $carry;
      }, collect());

      $start = Carbon::parse($booking_details->sortBy('event_start')->first()->event_start);
      $end = Carbon::parse($booking_details->sortByDesc('event_end')->first()->event_end);

      $event['date'] = $start->formatLocalized('%A, %d %B %Y').' s/d '.$end->formatLocalized('%A, %d %B %Y');
      $event['time'] = $start->format('H:i').' - '.$end->format('H:i');
      $event['rooms'] = $booking_details->unique('room_code')->implode('room_code', ', ');
      $event['title'] = $booking->event_title;
      $event['description'] = $booking->event_description;
      $event['pic_title_1'] = $booking->pic_title_1;
      $event['pic_name_1'] = $booking->pic_name_1;
      $event['pic_title_2'] = $booking->pic_title_2;
      $event['pic_name_2'] = $booking->pic_name_2;

      $data['booking_details'] = $pdf_data;
      $data['attachments'] = $attachment_data;
      $data['booking'] = (object) $event;
      $data['date'] = Carbon::parse($booking->created_at)->formatLocalized('%d %B %Y');
      $data['head_of_informatic'] = "Darlis Herumurti S.Kom.,M.Kom";

      $pdf = PDF::loadView('pdf.sub', $data);

      return $pdf->stream('surat_ijin.pdf'); 
    }

    protected function get_eligible_posters(Request $request) {
      if (!$request->date) {
        return "Please provide date";
      }

      $now = Carbon::parse($request->date)->addDays(1)->startOfDay()->timestamp;
      $until = Carbon::createFromTimestamp($now)->addDays(7)->timestamp;

      $raw_posters = collect(File::allFiles('storage/posters/'))->map(function($item) {
        $obj['filename'] = $item->getFilename();
        $obj['pathname'] = asset($item->getPathname());

        return (object)$obj;
      });

      $posters = $raw_posters->reduce(function($carry, $file) use ($now, $until, $request) {
        $file_data = explode('-', $file->filename);
        $booking = Booking::find($file_data[0]);
        $time = (int)$file_data[1];

        if ($time >= $now && $time <= $until && $booking->booking_status_id == $this->accepted_booking_status_id) {
          if ($request->room) {
            $in_room = BookingDetail::where('booking_id', $booking->id)
              ->join('rooms', 'booking_details.room_id', '=', 'rooms.id')
              ->where('rooms.room_code', '=', $request->room)
              ->get();

            if ($in_room->count()) {
              return $carry->push($file->pathname);
            }

            return $carry;
          }

          return $carry->push($file->pathname);
        }

        return $carry;
      }, collect());

      return $posters;
    }

    protected function set_one_detail($detail_id, $status_id){
      $booking = Booking::findOrFail($detail_id);
      $booking->booking_status_id = $status_id;

      return $booking->save();
    }

    protected function accept_detail($detail_id){
      return $this->set_one_detail($detail_id, $this->accepted_booking_status_id);
    }
    protected function reject_detail($detail_id){
      return $this->set_one_detail($detail_id, $this->rejected_booking_status_id);
    }

    protected function pending_detail($detail_id){
      return $this->set_one_detail($detail_id, $this->waiting_booking_status_id);
    }

    protected function get_all_booking(){
      return Booking::join('agencies', 'agencies.id','=','bookings.agency_id')
        ->join('categories', 'categories.id','=','bookings.category_id')
        ->join('booking_statuses', 'bookings.booking_status_id','=','booking_statuses.id')
        ->select(
          'bookings.id',
          'bookings.name',
          'bookings.event_title',
          'bookings.created_at',
          'booking_statuses.booking_status_name as status',
          'agencies.agency_name',
          'categories.category_name'
          )
        ->orderBy('bookings.created_at', 'DESC')
        ->paginate(10);
    }

    protected function get_all_booking_today(){
      return Booking::join('booking_details', 'booking_details.booking_id','=','bookings.id')
        ->join('rooms', 'booking_details.room_id','=','rooms.id')
        ->join('booking_statuses', 'bookings.booking_status_id','=','booking_statuses.id')
        ->where('booking_details.event_start', '>=', Carbon::today())
        ->where('booking_details.event_end', '<=', Carbon::tomorrow())           
        ->where('booking_statuses.id','=', $this->accepted_booking_status_id)
        ->select(
          'bookings.id', 
          'bookings.event_title', 
          'rooms.room_code',
          'rooms.room_name',
          'booking_statuses.booking_status_name',
          'booking_details.event_start',
          'booking_details.event_end'
          )
        ->paginate(10);
    }
    
    protected function get_booking_by_params($peminjam, $kegiatan, $status) {
      if(!$status) {
        return Booking::join('agencies', 'agencies.id','=','bookings.agency_id')
          ->join('categories', 'categories.id','=','bookings.category_id')
          ->join('booking_statuses', 'bookings.booking_status_id', '=', 'booking_statuses.id')
          ->whereRaw('lower(bookings.event_title) like ?', '%'.strtolower($kegiatan).'%')
          ->whereRaw('lower(bookings.name) like ?', '%'.strtolower($peminjam).'%')
          ->select(
            'bookings.id',
            'bookings.name',
            'bookings.event_title',
            'bookings.created_at',
            'booking_statuses.booking_status_name as status',
            'agencies.agency_name',
            'categories.category_name'
            )
          ->orderBy('bookings.created_at', 'DESC')
          ->paginate(10);
      }
      
      return Booking::join('agencies', 'agencies.id','=','bookings.agency_id')
        ->join('categories', 'categories.id','=','bookings.category_id')
        ->join('booking_statuses', 'bookings.booking_status_id', '=', 'booking_statuses.id')
        ->where('booking_statuses.id', '=', $status)
        ->whereRaw('lower(bookings.event_title) like ?', '%'.strtolower($kegiatan).'%')
        ->whereRaw('lower(bookings.name) like ?', '%'.strtolower($peminjam).'%')
        ->select(
          'bookings.id',
          'bookings.name',
          'bookings.event_title',
          'bookings.created_at',
          'booking_statuses.booking_status_name as status',
          'agencies.agency_name',
          'categories.category_name'
          )
        ->orderBy('bookings.created_at', 'DESC')
        ->paginate(10);
    }

    protected function get_booking_calendar($status_id, $start, $end){
      return Booking::join('booking_details', 'booking_details.booking_id','=','bookings.id')
        ->join('rooms', 'booking_details.room_id','=','rooms.id')
        ->join('booking_statuses', 'bookings.booking_status_id','=','booking_statuses.id')           
        ->where('booking_statuses.id','=', $status_id)
        ->where('event_start', '>=', $start)
        ->where('event_end', '<=', $end)
        ->select(
          DB::raw('CONCAT(
            "/reserve/status/",
            bookings.id
          ) as url'), 
          DB::raw("CONCAT(
            rooms.room_code,' ',
            bookings.event_title 
          ) as title"),
          'booking_details.event_start as start',
          'booking_details.event_end as end'
          )
        ->get();
    }

    protected function get_room_booking_calendar($status_id, $room_code, $start, $end){
      return Booking::join('booking_details', 'booking_details.booking_id','=','bookings.id')
        ->join('rooms', 'booking_details.room_id','=','rooms.id')
        ->where('room_code', '=', $room_code)
        ->join('booking_statuses', 'bookings.booking_status_id','=','booking_statuses.id')           
        ->where('booking_statuses.id','=', $status_id)
        ->where('event_start', '>=', $start)
        ->where('event_end', '<=', $end)
        ->select(
          DB::raw('CONCAT(
            "/reserve/status/",
            bookings.id
          ) as url'), 
          'bookings.event_title as title',
          'booking_details.event_start as start',
          'booking_details.event_end as end'
          )
        ->get();
    }

    protected function get_room_booking_status($status_id, $room_code, $time){
      return Booking::join('booking_details', 'booking_details.booking_id','=','bookings.id')
        ->join('rooms', 'booking_details.room_id','=','rooms.id')
        ->where('room_code', '=', $room_code)
        ->join('booking_statuses', 'bookings.booking_status_id','=','booking_statuses.id')           
        ->where('booking_statuses.id','=', $status_id)
        ->where('event_start', '<=', $time)
        ->where('event_end', '>=', $time)
        ->first();
    }

    protected function get_booking_calendar_accepted(Request $request){
      return $this->get_booking_calendar($this->accepted_booking_status_id, $request->start, $request->end);
    }

    protected function get_room_booking_calendar_accepted(Request $request, $room_code){
      return $this->get_room_booking_calendar($this->accepted_booking_status_id, $room_code, $request->start, $request->end);
    }

    protected function get_booking_calendar_waiting(Request $request){
      return $this->get_booking_calendar($this->waiting_booking_status_id, $request->start, $request->end);
    }

    protected function get_booking_calendar_rejected(Request $request){
      return $this->get_booking_calendar($this->rejected_booking_status_id, $request->start, $request->end);
    }

    protected function get_room_status(Request $request){
      return  $this->get_room_booking_status($this->accepted_booking_status_id, $request->roomCode, $request->time);
    }

    protected function get_one_booking($booking_id){
      return Booking::where('bookings.id', $booking_id)
        ->join('agencies', 'agencies.id','=','bookings.agency_id')
        ->join('categories', 'categories.id','=','bookings.category_id')
        ->join('booking_statuses', 'booking_statuses.id','=','bookings.booking_status_id')
        ->select(
          'bookings.id',
          'bookings.name',
          'bookings.nrp_nip',
          'bookings.email',
          'bookings.phone_number',
          'bookings.event_title',
          'bookings.event_description',

          'bookings.pic_title_1', 
          'bookings.pic_name_1', 
          'bookings.pic_title_2', 
          'bookings.pic_name_2', 
          'bookings.poster_imagepath',

          'booking_statuses.id as overall_status_id',
          'booking_statuses.booking_status_name as overall_status',
          'agencies.agency_name',
          'categories.category_name'
          )
        ->first();        
    }

    protected function get_one_detail($detail_id){
      return BookingDetail::where('booking_details.id', $detail_id)
        ->join('rooms', 'rooms.id','=','booking_details.room_id')
        ->select(
          'booking_details.id',
          'booking_details.event_start',
          'booking_details.event_end',
          'rooms.id as room_id',
          'rooms.room_code',
          'rooms.room_name'
          )
        ->first();
    }

    protected function get_all_detail($booking_id){
      return Booking::where('bookings.id', $booking_id)
        ->join('booking_details', 'booking_details.booking_id','=','bookings.id')
        ->join('rooms', 'rooms.id','=','booking_details.room_id')
        ->join('booking_statuses', 'booking_statuses.id','=','bookings.booking_status_id')
        ->select(
          'booking_details.id',
          'booking_details.event_start',
          'booking_details.event_end',
          'rooms.id as room_id',
          'rooms.room_code',
          'rooms.room_name',
          'booking_statuses.id as booking_status_id',
          'booking_statuses.booking_status_name'
          )
        ->orderBy('booking_statuses.id', 'DESC')
        ->orderBy('booking_details.event_start')
        ->orderBy('rooms.room_code')
        ->get();
    }

    protected function get_all_detail_paginate($booking_id){
      return Booking::where('bookings.id', $booking_id)
        ->join('booking_details', 'booking_details.booking_id','=','bookings.id')
        ->join('rooms', 'rooms.id','=','booking_details.room_id')
        ->join('booking_statuses', 'booking_statuses.id','=','bookings.booking_status_id')
        ->select(
          'booking_details.id',
          'booking_details.event_start',
          'booking_details.event_end',
          'rooms.id as room_id',
          'rooms.room_code',
          'rooms.room_name',
          'booking_statuses.id as booking_status_id',
          'booking_statuses.booking_status_name'
          )
        ->orderBy('booking_statuses.id', 'DESC')
        ->orderBy('booking_details.event_start')
        ->orderBy('rooms.room_code')
        ->paginate(10);
    }

    protected function get_all_detail_by_time($start, $end){
        return Booking::join('booking_details', 'booking_details.booking_id','=','bookings.id')
            ->join('rooms', 'booking_details.room_id','=','rooms.id')
            ->join('booking_statuses', 'bookings.booking_status_id','=','booking_statuses.id')
            ->where('booking_details.event_start', '>=', $start)
            ->where('booking_details.event_end', '<=', $end)           
            ->where('booking_statuses.id','=', $this->accepted_booking_status_id)
            ->select(
                'bookings.id', 
                'bookings.event_title', 
                'bookings.event_description',
                'rooms.room_code',
                'booking_details.event_start',
                'booking_details.event_end'
                )
            ->get();
    }
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
            'booking_status_id' => $this->waiting_booking_status_id,
            'pic_title_1' => $request->pic_title_1,            
            'pic_name_1' => $request->pic_name_1,            
        ]);
    }

    /**
     * Helper Function - Sent Email
     * @param Integer $booking_id
     * @return.
     */
    protected function send_email($booking_id){
      $technicians = Booking::where('bookings.id', $booking_id)
        ->join('booking_details', 'booking_details.booking_id', '=', 'bookings.id')
        ->join('rooms_technicians', 'rooms_technicians.room_id', '=', 'booking_details.room_id')
        ->join('users', 'users.id', '=', 'rooms_technicians.user_id')
        ->select('users.*')
        ->groupBy('email')
        ->get();
      $headers = "From: <no-reply.reservasi@if.its.ac.id>"."\r\n";

      foreach($technicians as $technician){
        Mail::send(new BookingNotification($technician));
      }
    }

    /**
     * Helper Functions - Create Booking Detail
     * @param  Integer $room_id
     * @param  Integer $booking_id
     * @param  String $start_time
     * @param  String $end_time
     * @return App\BookingDetail
     */
    protected function create_booking_detail($room_id, $booking_id, $start_time, $end_time){
        return BookingDetail::create([
            'booking_id' => $booking_id,
            'room_id' => $room_id,
            'event_start' => $start_time,
            'event_end' => $end_time,
        ]);
    }

    public function multirepeat(Request $request){
        $this->validator_room($request, true)->validate();
        $this->validator_form($request)->validate();
        

        $start_time = new Carbon($request->start_date." ".$request->start_time);
        $end_time = new Carbon($request->start_date." ".$request->end_time);

        //Check if event crash with another
        for ($i = 0; $i < $request->howmanytimes ; $i++) {
          if ($i != 0) { 
            $start_time = $start_time->addSeconds($request->routine);
            $end_time = $end_time->addSeconds($request->routine);
          }
          foreach ($request->room as $key => $value) {
            if ($this->check_crash_v2($value, $start_time->toDateTimeString(), $end_time->toDateTimeString())) {
              return redirect('reserve')->withInput($request->input())->withErrors(collect(['Reservasi gagal. Terdapat acara lain pada saat yang sama, mohon cek lagi waktu peminjaman anda.']));
            }
          }
        }
 
        $start_time = new Carbon($request->start_date." ".$request->start_time);
        $end_time = new Carbon($request->start_date." ".$request->end_time);

        if ($request->nrp_nip == ''){
          $request->nrp_nip = '-';
        }
        if ($request->pic_title_1 == '') {
          $request->pic_title_1 = 'Peminjam';
        }
        if ($request->pic_name_1 == ''){
          $request->pic_name_1 = $request->full_name;
        }

        $booking = $this->create_booking($request);
        if ($request->pic_title_2 !== '' && $request->pic_name_2 !== '') {
          $booking->pic_title_2 = $request->pic_title_2;
          $booking->pic_name_2 = $request->pic_name_2;
          $booking->save();
        }
      
        foreach ($request->room as $key => $value) {
          $this->create_booking_detail(
            $value,
            $booking->id,
            $start_time->toDateTimeString(),
            $end_time->toDateTimeString()
          );
        }

        for ($i=1; $i < $request->howmanytimes ; $i++) {
          $start_time = $start_time->addSeconds($request->routine);
          $end_time = $end_time->addSeconds($request->routine);
          foreach ($request->room as $key => $value) {
            $this->create_booking_detail(
              $value,
              $booking->id,
              $start_time->toDateTimeString(),
              $end_time->toDateTimeString()
            );
          }
        }

        if ($request->hasFile('poster_imagepath') && $request->file('poster_imagepath')->isValid()) {
          $image = $request->file('poster_imagepath');
          $image_name = $booking->id.'-'.($start_time->timestamp).'.'.$image->getClientOriginalExtension();
          $image->storeAs('public/posters', $image_name);
          $booking->poster_imagepath = 'storage/posters/'.$image_name;
          $booking->save();
        }

        return redirect('reserve')->with('message', 'Berhasil Mengajukan Reservasi #'.$booking->id.'. Mohon segera mencetak surat ijin dan mengajukannya kepada Kepala Departemen.');
    }

    /**
     * Helper Functions - Check Booking Crash
     */
    public function check_crash($booking_id, $detail_id, $room_id, $event_start, $event_end){
        return BookingDetail::join('rooms', 'rooms.id','=','booking_details.room_id')
            ->join('bookings', 'bookings.id','=', 'booking_details.booking_id')
            ->join('booking_statuses', 'booking_statuses.id','=','bookings.booking_status_id')
            ->where(function($query) use ($detail_id, $room_id, $event_start, $event_end){
                    $query
                    ->where('booking_details.id', '<>', $detail_id)
                    ->where('rooms.id', '=', $room_id)
                    ->where('booking_statuses.id', '=', $this->accepted_booking_status_id)
                    ->where('booking_details.event_start','>', $event_start)
                    ->where('booking_details.event_start', '<', $event_end);
                })
            ->orWhere(function($query)  use ($detail_id, $room_id,$event_start, $event_end){
                    $query
                    ->where('booking_details.id', '<>', $detail_id)
                    ->where('rooms.id', '=', $room_id)
                    ->where('booking_statuses.id', '=', $this->accepted_booking_status_id)
                    ->where('booking_details.event_end','>', $event_start)
                    ->where('booking_details.event_end', '<', $event_end);
                })
            ->orWhere(function($query)  use ($detail_id, $room_id,$event_start, $event_end){
                    $query
                    ->where('booking_details.id', '<>', $detail_id)
                    ->where('rooms.id', '=', $room_id)
                    ->where('booking_statuses.id', '=', $this->accepted_booking_status_id)
                    ->where('booking_details.event_start','<', $event_start)
                    ->where('booking_details.event_end', '>', $event_end);
                })
            ->orWhere(function($query)  use ($booking_id, $detail_id, $room_id,$event_start, $event_end){
                    $query
                    ->where('booking_details.id', '<>', $detail_id)
                    ->where('rooms.id', '=', $room_id)
                    ->where('bookings.id', '=', $booking_id)
                    ->where('booking_details.event_start','>', $event_start)
                    ->where('booking_details.event_start', '<', $event_end);
                })
            ->orWhere(function($query)  use ($booking_id, $detail_id, $room_id,$event_start, $event_end){
                    $query
                    ->where('booking_details.id', '<>', $detail_id)
                    ->where('rooms.id', '=', $room_id)
                    ->where('bookings.id', '=', $booking_id)
                    ->where('booking_details.event_end','>', $event_start)
                    ->where('booking_details.event_end', '<', $event_end);
                })
            ->orWhere(function($query)  use ($booking_id, $detail_id, $room_id,$event_start, $event_end){
                    $query
                    ->where('booking_details.id', '<>', $detail_id)
                    ->where('rooms.id', '=', $room_id)
                    ->where('bookings.id', '=', $booking_id)
                    ->where('booking_details.event_start','<', $event_start)
                    ->where('booking_details.event_end', '>', $event_end);
                })
            ->select(
                'booking_details.id',
                'booking_details.event_start',
                'booking_details.event_end'
                )
            ->get();
    }

    /**
     * Helper function - Check crash v2
     */
    protected function check_crash_v2($room_id, $start, $end) {
      $start_between = Booking::where('booking_status_id', '=', $this->accepted_booking_status_id)
        ->join('booking_details', 'booking_details.booking_id', '=', 'bookings.id')
        ->where('booking_details.room_id', $room_id)
        ->where('booking_details.event_start', '<=', $start)
        ->where('booking_details.event_end', '>', $start)
        ->first();
      $end_between = Booking::where('booking_status_id', '=', $this->accepted_booking_status_id)
        ->join('booking_details', 'booking_details.booking_id', '=', 'bookings.id')
        ->where('booking_details.room_id', $room_id)
        ->where('booking_details.event_start', '<', $end)
        ->where('booking_details.event_end', '>=', $end)
        ->first();
      $event_between= Booking::where('booking_status_id', '=', $this->accepted_booking_status_id)
        ->join('booking_details', 'booking_details.booking_id', '=', 'bookings.id')
        ->where('booking_details.room_id', $room_id)
        ->where('booking_details.event_start', '>=', $start)
        ->where('booking_details.event_end', '<=', $end)
        ->first();

      return $start_between || $end_between || $event_between;
    }

    protected function error_message($booking_id, $detail_id){
      return 'Gagal menerima Detail Reservasi #'.$booking_id.'-'.$detail_id.", Bentrok;  ";
    }

    public function accept_all_reservation(Request $request){
        $this->validator_booking($request)->validate();

        $bookings = $this->get_all_detail($request->booking_id);
        if (!$bookings->count()){
            return redirect('reserve/status/'.$request->booking_id)->withErrors('Tidak ada detail reservasi');
        }

        $crash_count = 0;
        $crash_id = [];
        foreach ($bookings as $detail) {
            $crash = $this->check_crash(
                    $request->booking_id,
                    $detail->id,
                    $detail->room_id,
                    $detail->event_start,
                    $detail->event_end
                );
            if ( $crash->count() ) {
                $this->reject_detail($request->booking_id);
                $crash_id = array_add($crash_id, $crash_count, $detail->id);
                $crash_count = $crash_count + 1;
            }
        }

        if (!$crash_count) {    
            $this->accept_detail($request->booking_id);
            return redirect('reserve/status/'.$request->booking_id)
                ->with('message', 'Berhasil mengubah status reservasi #'.$request->booking_id.' menjadi DITERIMA');
        } else {
            $message = 'Gagal menerima reservasi dikarenakan Detail Reservasi dengan ID berikut Bentrok: ';

            $crash_id = array_sort($crash_id);
            for ($i=0; $i < $crash_count; $i++) { 
                $message = $message.' #'.$request->booking_id.'-'.array_get($crash_id, $i).';';
            }

            return redirect('reserve/status/'.$request->booking_id)->withErrors($message);
        }
    }

    public function reject_all_reservation(Request $request){
        $this->validator_booking($request)->validate();

        $this->reject_detail($request->booking_id);
        return redirect('reserve/status/'.$request->booking_id)
            ->with('message', 'Berhasil mengubah status reservasi #'.$request->booking_id.' menjadi DITOLAK');
    }

    public function pending_all_reservation(Request $request){
        $this->validator_booking($request)->validate();

        $this->pending_detail($request->booking_id);
        return redirect('reserve/status/'.$request->booking_id)
            ->with('message', 'Berhasil mengubah status reservasi #'.$request->booking_id.' menjadi MENUNGGU');
    }

    public function accept_one_reservation(Request $request){
        $this->validator_detail($request)->validate();
        $booking_detail = $this->get_one_detail($request->detail_id);
        if ( $this->check_crash(
                $request->booking_id,
                $request->detail_id,
                $booking_detail->room_id, 
                $booking_detail->event_start, 
                $booking_detail->event_end
            )->count() ){
            return redirect('reserve/status/'.$request->booking_id)->withErrors($this->error_message($request->booking_id, $request->detail_id));
        } else {
            $this->accept_detail($request->detail_id);
            return redirect('reserve/status/'.$request->booking_id)
                ->with('message', 'Berhasil mengubah status detail reservasi #'.$request->booking_id.'-'.$request->detail_id.' menjadi DITERIMA');
        }
    }

    public function reject_one_reservation(Request $request){
        $this->validator_detail($request)->validate();
        $this->reject_detail($request->detail_id);
        return redirect('reserve/status/'.$request->booking_id)
            ->with('message', 'Berhasil mengubah status detail reservasi #'.$request->booking_id.'-'.$request->detail_id.' menjadi DITOLAK');
    }

    public function pending_one_reservation(Request $request){
        $this->validator_detail($request)->validate();
        $this->pending_detail($request->detail_id);
        return redirect('reserve/status/'.$request->booking_id)->with('message', 'Berhasil mengubah status detail reservasi #'.$request->booking_id.'-'.$request->detail_id.' menjadi MENUNGGU');
    }

    public function edit_one_reservation(Request $request){
        $this->validator_room($request, false)->validate();
        $this->validator_time($request)->validate();

        $booking = Booking::findOrFail($request->booking_id);
        $booking->booking_status_id = $this->waiting_booking_status_id;
        $booking->save(); 

        $detail = BookingDetail::find($request->detail_id);
        $detail->room_id = $request->room;
        $start_time = new Carbon($request->start_date." ".$request->start_time);
        $end_time = new Carbon($request->start_date." ".$request->end_time);
        $detail->event_start = $start_time->toDateTimeString();
        $detail->event_end = $end_time->toDateTimeString();
        $detail->save();

        return redirect('reserve/status/'.$request->booking_id)->with('message', 'Berhasil memerbarui status detail reservasi #'.$request->booking_id.'-'.$request->detail_id);
    }

    public function add_one_reservation(Request $request){
        $this->validator_room($request, true)->validate();
        $this->validator_time($request)->validate();

        $booking = Booking::findOrFail($request->booking_id);
        $booking->booking_status_id = $this->waiting_booking_status_id;
        $booking->save(); 

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
        for ($i=1; $i < $request->howmanytimes ; $i++) {$start_time = $start_time->addSeconds($request->routine);
            $end_time = $end_time->addSeconds($request->routine);
            foreach ($request->room as $key => $value) {
                $this->create_booking_detail(
                    $value,
                    $booking->id,
                    $start_time->toDateTimeString(),
                    $end_time->toDateTimeString()
                );
            }
        }

        return redirect('reserve/status/'.$request->booking_id)->with('message', 'Berhasil menambah detail ruangan reservasi #'.$request->booking_id);
    }

    public function delete_one_detail(Request $request){
        $bookingDetail = BookingDetail::findOrFail($request->detail_id);
        $bookingDetail->delete();

        $this->pending_detail($request->booking_id);
        return redirect('reserve/status/'.$request->booking_id)->with('message', 'Berhasil menghapus status detail reservasi #'.$request->booking_id.'-'.$bookingDetail->id);
    }

    public function delete_all_detail(Request $request){
        $booking = Booking::findOrFail($request->booking_id);
        $booking->bookingDetail()->delete();

        $this->pending_detail($request->booking_id);
        return redirect('reserve/status/'.$request->booking_id)->with('message', 'Berhasil menghapus seluruh detail reservasi #'.$request->booking_id);
    }

    public function edit_reservation_greater_detail(Request $request){
      // validate

      $booking = Booking::findOrFail($request->booking_id);
      $booking->name = $request->full_name;
      $booking->nrp_nip = $request->nrp_nip;
      $booking->phone_number = $request->phone_number;
      $booking->email = $request->email;
      $booking->pic_title_1 = $request->pic_title_1;
      $booking->pic_title_2 = $request->pic_title_2;
      $booking->pic_name_1 = $request->pic_name_1;
      $booking->pic_name_2 = $request->pic_name_2;
      $booking->event_title = $request->title;
      $booking->event_description = $request->event_description;

      if ($request->nrp_nip == ''){
        $booking->nrp_nip = '-';
      }
      if ($request->pic_title_1 == '') {
        $booking->pic_title_1 = 'Peminjam';
      }
      if ($request->pic_name_1 == ''){
        $booking->pic_name_1 = $request->full_name;
      }

      $booking->save();

      $start_time = BookingDetail::where( 'booking_details.booking_id', '=', $booking->id)
      ->select('booking_details.event_start')
      ->orderBy('booking_details.event_start', 'ASC')
      ->first();

      if ($request->hasFile('poster_imagepath') && $request->file('poster_imagepath')->isValid()) {
        $image = $request->file('poster_imagepath');
        $image_name = $booking->id.'-'.(Carbon::parse($start_time->event_start)->timestamp).'.'.$image->getClientOriginalExtension();
        $image->storeAs('public/posters', $image_name);
        $booking->poster_imagepath = 'storage/posters/'.$image_name;
        $booking->save();
      }

      $this->pending_detail($booking->id);

      return redirect('reserve/status/'.$request->booking_id)->with('message', 'Berhasil mengubah detail kegiatan reservasi #'.$request->booking_id);
    }

    public function delete_image(Request $request){
      $booking = Booking::findOrFail($request->booking_id);
      if (File::exists($booking->poster_imagepath)){
        File::delete($booking->poster_imagepath);
      }
      $booking->poster_imagepath = '';
      $booking->save();

      return redirect('reserve/status/'.$request->booking_id)->with('message', 'Berhasil menghapus poster kegiatan reservasi #'.$request->booking_id);
    }

    public function delete_reservation(Request $request){
      $booking = Booking::findOrFail($request->booking_id);
      $booking->bookingDetail()->delete();

      if (File::exists($booking->poster_imagepath)){
        File::delete($booking->poster_imagepath);
      }
      $booking->poster_imagepath = '';

      $booking->delete();

      return redirect('reserve/status')->with('message', 'Berhasil menghapus data kegiatan reservasi #'.$request->booking_id);
    }
}
