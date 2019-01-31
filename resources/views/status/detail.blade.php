@extends('layouts.master')

@section('title','ReservasiTC | Detail')

@section('css')
  <style type="text/css">
    .btn {
      margin: 0.3rem;
    }
  </style>
@endsection

@section('content')
  <div class="container" style="width:80%">
  <h1>Detail Reservasi</h1>
  @include('layouts.status')
  @include('layouts.errors')

  <div class="row">
    @if ($booking)
      @component('status.detail_div')
        @slot('title', 'Nomor Reservasi')
        #{{$booking->id}}
      @endcomponent

      @component('status.detail_div')
        @slot('title', 'Peminjam')
        {{$booking->name}}
      @endcomponent

      @if (Auth::check())
        @if (!empty($booking->nrp_nip))
          @component('status.detail_div')
            @slot('title', 'NRP / NIP')
            {{$booking->nrp_nip}}
          @endcomponent
        @endif

        @component('status.detail_div')
          @slot('title', 'Email')
          {{$booking->email}}
        @endcomponent

        @component('status.detail_div')
          @slot('title', 'Nomor Telepon')
          {{$booking->phone_number}}
        @endcomponent
      @endif

      @component('status.detail_div')
        @slot('title', 'Perwakilan')
        {{$booking->agency_name}}
      @endcomponent

      @component('status.detail_div')
        @slot('title', 'Judul Kegiatan')
        {{$booking->event_title}}
      @endcomponent

      @component('status.detail_div')
        @slot('title', 'Kategori Kegiatan')
        {{$booking->category_name}}
      @endcomponent

      @component('status.detail_div')
        @slot('title', 'Deskripsi Kegiatan')
        {{$booking->event_description}}
      @endcomponent

      @component('status.detail_div')
        @slot('title', 'Penanggung Jawab')
        <ol>
          @if ($booking->pic_title_2 && $booking->pic_name_2)
            <li>{{$booking->pic_title_2}}: {{$booking->pic_name_2}}</li>
          @endif
          <li>{{$booking->pic_title_1}}: {{$booking->pic_name_1}}</li>
        </ol>
      @endcomponent

      @component('status.detail_div')
        @slot('title')
          Poster Kegiatan
        @endslot
        @if ($booking->poster_imagepath)
          <div class="card col s6">
            <div class="card-image">
              <img src="{{asset($booking->poster_imagepath)}}">
            </div>
          </div>
        @else
          Poster tidak tersedia
        @endif
      @endcomponent

      @if (Auth::check())
        @component('status.detail_div')
          @slot('title')
            Hapus Gambar
          @endslot
          <div class="row">
            <div class="col s12">
              <button class="btn waves-effect waves-light red modal-trigger" data-target="delete_image" onclick="fill_modal('delete_image', {{$booking->id}})">
                Hapus Gambar
              </button>
            </div>
          </div>
        @endcomponent

        @component('status.detail_div')
          @slot('title')
            Ubah Detail Reservasi
          @endslot
          <div class="row">
            <div class="col s12">
              <button class="btn waves-effect waves-light red modal-trigger" data-target="delete_reservation" onclick="fill_modal('delete_reservation', {{$booking->id}})">
                Hapus Reservasi
              </button>
              <a class="btn waves-effect waves-light blue darken-4" href="{{url('reserve/edit/'.$booking->id)}}">Edit reservasi</a>
            </div>
          </div>
        @endcomponent
      @endif

      @component('status.detail_div')
        @slot('title', 'Status')
        <div class="row">
          <div class="col s12 m6">
            @if ($booking->overall_status_id == $accepted_id)
              <div class="card horizontal blue darken-4 white-text">
            @elseif ($booking->overall_status_id == $rejected_id)
              <div class="card horizontal red white-text">
            @else 
              <div class="card horizontal orange white-text">
            @endif
                <div class="card-content">
                  <strong>
                    {{$booking->overall_status}}
                  </strong>
                </div>
              </div>
          </div>
        </div>
      @endcomponent

      @if ($booking->overall_status_id == $waiting_id)
        @component('status.detail_div')
          @slot('title', 'Print Surat Ijin')
          <div class="row">
            <div class="col s12 m6">
              <a href="{{url('reserve/status/'.$booking->id.'/surat_ijin_v2')}}" class="btn waves-effect waves-light orange">Print Surat</a>
            </div>
          </div>
        @endcomponent
      @endif

      @if (Auth::check())
        @component('status.detail_div')
          @slot('title', 'Ubah Status')
          <div class="row">
            <div class="col s12">
              <button class="btn waves-effect waves-light red modal-trigger" data-target="reject_all" onclick="fill_modal('reject_all', '{{ $booking->id }}','')"> 
                Tolak
              </button>
              <button class="btn waves-effect waves-light orange modal-trigger" data-target="pending_all" onclick="fill_modal('pending_all', '{{ $booking->id }}','')"> 
                Tunggu
              </button>
              <button class="btn waves-effect waves-light blue darken-4 modal-trigger" data-target="accept_all" onclick="fill_modal('accept_all', '{{ $booking->id }}','')"> 
                Terima
              </button>
            </div>
          </div>
        @endcomponent

        @component('status.detail_div')
          @slot('title', 'Ubah Detail Lokasi')
          <div class="row">
            <div class="col s12">
              <button class="btn waves-effect waves-light red modal-trigger" data-target="delete_all" onclick="fill_modal('delete_all', '{{$booking->id}}', '')">
                Hapus Semua Lokasi
              </button>
              <button class="btn waves-effect waves-light blue darken-4 modal-trigger" data-target="add_detail" onclick="fill_modal('add_detail', '{{$booking->id}}', '')">
                Tambah Lokasi
              </button>
            </div>
          </div>
        @endcomponent
      @endif


      @if (count($booking_details))
      <h4>Detail Waktu dan Tempat</h4>
      <table class="responsive-table highlight centered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Ruangan</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Agenda</th>
            @if (Auth::check())
              <th>Aksi</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @foreach ($booking_details as $detail)
            <tr>
              <td>#{{$booking->id}}-{{$detail->id}}</td>
              <td>{{$detail->room_code}} ({{$detail->room_name}})</td>
              <td>
                {{ \Carbon\Carbon::parse($detail->event_start)->format('l, jS \\of F Y') }}
              </td>
              <td>
                {{ \Carbon\Carbon::parse($detail->event_start)->format('H:i') }} s/d {{ \Carbon\Carbon::parse($detail->event_end)->format('H:i') }}
              </td>
              <td>
                <div class="row">
                  <div class="col s12">
                    <a href="{{url('/agenda/'.$detail->room_code)}}" class="btn waves-effect waves-light darken-4 blue">
                      Agenda
                    </a>
                  </div>
                </div>
              </td>
              @if (Auth::check())
                <td>
                  <div class="row">
                    <div class="col s12">
                      <button class="btn waves-effect waves-light blue darken-4 modal-trigger right" data-target="edit_detail" onclick="
                        fill_edit_detail(
                          '{{$booking->id}}',
                          '{{$detail->id}}', 
                          '{{$detail->room_id}}', 
                          '{{\Carbon\Carbon::parse($detail->event_start)->format('Y-m-d')}}',
                          '{{\Carbon\Carbon::parse($detail->event_start)->format('H:i')}}',
                          '{{\Carbon\Carbon::parse($detail->event_end)->format('H:i')}}',
                          '{{$detail->booking_status_id}}'
                          )
                        "> 
                        Edit
                      </button>
                      <button class="btn waves-effect waves-light red modal-trigger" data-target="delete_detail" onclick="fill_modal('delete_detail', '{{$booking->id}}', '{{$detail->id}}')">
                        Hapus
                      </button>
                    </div>
                  </div>
                </td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
      @else
        Belum ada detail reservasi
      @endif
      
    @endif
  </div>

  {{$booking_details->render()}}

  @if (Auth::check())
    @component('status.detail_modal')
      @slot('modal_id', 'pending_all')
      @slot('title', 'Konfirmasi Perubahan Status')
      @slot('content', 'Apakah anda yakin ingin mengubah status reservasi ini menjadi MENUNGGU ?')
      @slot('routing')
        {{url('/reserve/status/pending_all')}}
      @endslot
      @slot('button_class', 'orange')
      @slot('button', 'Tunggu')
    @endcomponent

    @component('status.detail_modal')
      @slot('modal_id', 'reject_all')
      @slot('title', 'Konfirmasi Perubahan Status')
      @slot('content', 'Apakah anda yakin ingin mengubah status reservasi ini menjadi DITOLAK?')
      @slot('routing') 
        {{url('/reserve/status/reject_all')}} 
      @endslot
      @slot('button_class', 'red')
      @slot('button', 'Tolak')
    @endcomponent

    @component('status.detail_modal')
      @slot('modal_id', 'accept_all')
      @slot('title', 'Konfirmasi Perubahan Status')
      @slot('content', 'Apakah anda yakin ingin mengubah status reservasi ini menjadi DITERIMA?')
      @slot('routing') 
        {{url('/reserve/status/accept_all')}} 
      @endslot
      @slot('button_class', 'blue darken-4')
      @slot('button', 'Terima')
    @endcomponent

    @component('status.detail_modal')
      @slot('modal_id', 'delete_detail')
      @slot('title', 'Konfirmasi Penghapusan Detail Reservasi')
      @slot('content', 'Apakah anda yakin ingin menghapus detail lokasi ini ?')
      @slot('routing')
        {{url('/reserve/status/delete')}}
      @endslot
      @slot('button_class', 'red')
      @slot('button', 'Hapus Detail')
    @endcomponent

    @component('status.detail_modal')
      @slot('modal_id', 'delete_all')
      @slot('title', 'Konfirmasi Penghapusan Detail Reservasi')
      @slot('content', 'Apakah anda yakin ingin menghapus SELURUH detail lokasi ini ?')
      @slot('routing')
        {{url('/reserve/status/delete_all')}}
      @endslot
      @slot('button_class', 'red')
      @slot('button', 'Hapus Semua')
    @endcomponent

    @component('status.detail_modal')
      @slot('modal_id', 'delete_image')
      @slot('title', 'Konfirmasi Penghapusan Poster Kegiatan')
      @slot('content', 'Apakah anda yakin ingin menghapus poster kegiatan ini? Gambar akan terhapus permanen')
      @slot('routing')
        {{url('/reserve/image/delete')}}
      @endslot
      @slot('button_class', 'red')
      @slot('button', 'Hapus Gambar')
    @endcomponent

    @component('status.detail_modal')
      @slot('modal_id', 'delete_reservation')
      @slot('title', 'Konfirmasi Penghapusan Reservasi')
      @slot('content', 'Apakah anda yakin ingin menghapus reservasi ini? (Reservasi yang terhapus masih dapat dilihat dalam database)')
      @slot('routing')
        {{url('/reserve/delete')}}
      @endslot
      @slot('button_class', 'red')
      @slot('button', 'Hapus Reservasi')
    @endcomponent

    <div id="edit_detail" class="modal">
      <div class="modal-header">
        <a class="btn btn-flat right modal-close">&times;</a>
      </div>
      <div class="modal-content">
        <h4>Edit Detail Reservasi</h4>
        <form id="form_edit_detail" method="POST" action="{{url('/reserve/status/edit')}}">
          {{csrf_field()}}
          <input type="hidden" name="booking_id" value="">
          <input type="hidden" name="detail_id" value="">
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">room</i>            
              <select name='room' required>
                @foreach ($rooms as $room)
                  <option value='{{$room->id}}'> {{$room->room_code}} ({{$room->room_name}}) </option>
                @endforeach
              </select>
              <label for="room">Ruangan</label>
              <span class="helper-text">
                Pilih Ruangan yang akan Anda Gunakan
                <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan ruangan yang akan Anda gunakan tersedia">help</i>
              </span>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">date_range</i>
              <input type="text" class="datepicker validate" id="start_date_edit" required>
              <span class="helper-text">
                Pilih Tanggal Acara Anda (Format: YYYY-MM-DD)
                <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan hari yang anda pilih sesuai dengan syarat dan ketentuan">help</i>
              </span>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6">
              <i class="material-icons prefix">access_time</i>
              <input type="text" class="timepicker validate" id="start_time_edit" required>
              <span class="helper-text">
                Pilih Waktu Mulai Acara
                <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan waktu yang anda pilih sesuai dengan syarat dan ketentuan">help</i>
              </span>
            </div>
            <div class="input-field col s12 m6">
              <i class="material-icons prefix"></i>
              <input type="text" class="timepicker validate" id="end_time_edit" required>
              <span class="helper-text">
                Pilih Waktu Selesai Acara
                <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan waktu yang anda pilih sesuai dengan syarat dan ketentuan">help</i>
              </span>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <a class="btn waves-effect waves-light grey modal-close">
          Kembali
        </a>
        <button class="btn waves-effect waves-light blue darken-4" onclick="submit_form('form_edit_detail')">
          Edit
        </button>
      </div>
    </div>


    <div id="add_detail" class="modal">
      <div class="modal-header">
        <a class="btn btn-flat right modal-close">&times;</a>
      </div>
      <div class="modal-content">
        <h4>Tambah Detail Reservasi</h4>
        <form id="form_add_detail" method="POST" action="{{url('/reserve/status/add')}}">
          {{csrf_field()}}
          <input type="hidden" name="booking_id" value="">
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">room</i>            
              <select name='room[]' multiple required>
                <option value="" disabled>Choose Room</option>
                @foreach ($rooms as $room)
                  <option value='{{$room->id}}'> {{$room->room_code}} ({{$room->room_name}}) </option>
                @endforeach
              </select>
              <label for="room">Ruangan</label>
              <span class="helper-text">
                Pilih Ruangan yang akan Anda Gunakan
                <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan ruangan yang akan Anda gunakan tersedia">help</i>
              </span>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">date_range</i>
              <input type="text" class="datepicker validate" id="start_date" required>
              <label for="start_date">Tanggal</label>
              <span class="helper-text">
                Pilih Tanggal Acara Anda (Format: YYYY-MM-DD)
                <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan hari yang anda pilih sesuai dengan syarat dan ketentuan">help</i>
              </span>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6">
              <i class="material-icons prefix">access_time</i>
              <input type="text" class="timepicker validate" id="start_time" required>
              <label for="start_time">Waktu Mulai</label>
              <span class="helper-text">
                Pilih Waktu Mulai Acara
                <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan waktu yang anda pilih sesuai dengan syarat dan ketentuan">help</i>
              </span>
            </div>
            <div class="input-field col s12 m6">
              <i class="material-icons prefix"></i>
              <input type="text" class="timepicker validate" id="end_time" required>
              <label for="end_time">Waktu Selesai</label>
              <span class="helper-text">
                Pilih Waktu Selesai Acara
                <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan waktu yang anda pilih sesuai dengan syarat dan ketentuan">help</i>
              </span>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6">
              <i class="material-icons prefix"></i>
              <select id="routine" name="routine" required>
                @foreach ($routines as $routine)
                  <option value="{{$routine->repeat_in_sec}}">{{$routine->routine_name}}</option>
                @endforeach
              </select>
              <label for="routine">Rutinitas</label>
              <span class="helper-text">
                Pilihlah jeda rutinitas kegiatan Anda
                <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan rutinitas yang anda pilih benar">help</i>
              </span>
            </div>
            <div class="input-field col s12 m6">
              <i class="material-icons prefix"></i> 
              <input type="number" id="howmanytimes" name="howmanytimes" min="1" max="20" value="{{old('howmanytimes')}}" required>
              <label for="howmanytimes">Berapa kali</label>
              <span class="helper-text">
                Masukkan banyak perulangan peminjaman
                <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Minimum perulangan adalah sekali (1x) dan maksimum perulangan adalah dua puluh kali (20x)">help</i>
              </span>
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <button class="btn waves-effect waves-light blue darken-4 right" type="submit">
                Tambah <i class="material-icons right">send</i>
              </button>
              <button class="btn waves-effect waves-light grey modal-close right" style="margin-right:0.3rem;">
                Kembali
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  @endif
@endsection

@section('js')
  <script type="text/javascript">
    function fill_modal(modal_id, booking_id, detail_id){
      if(booking_id){
        $("#"+modal_id+" input[name='booking_id']").val(booking_id);
      }
      if(detail_id){
        $("#"+modal_id+" input[name='detail_id']").val(detail_id);
      }
    }

    function submit_form(form_id){
      document.getElementById(form_id).submit();
    }
    
    function fill_edit_detail(booking_id, detail_id, room_id, date, start, end, status){
      $('#edit_detail input[name="booking_id"').val(booking_id);
      $('#edit_detail input[name="detail_id"').val(detail_id);
      $('#edit_detail input[name="start_date"]').val(date);
      $('#edit_detail input[name="start_time"]').val(start);
      $('#edit_detail input[name="end_time"]').val(end);
      $('#edit_detail select[name="room"]').val(room_id);
      $('select').formSelect();
    }

    $(document).ready(function(){
      $('.modal').modal();
      $('select').formSelect();
      $("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
      $('.datepicker').datepicker({
        container: 'body',
        format: 'yyyy-mm-dd',
      });
      $('.timepicker').timepicker({
        container: 'body',
        twelveHour: false,
      });
      $('.tooltipped').tooltip();

    })
  </script>
  </div>
@endsection
