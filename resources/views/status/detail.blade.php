@extends('layouts.master')

@section('title','ReservasiTC | Detail')

@section('content')
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

      @if (Auth::check() && Auth::user()->hasRole('manage_room'))
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
        @slot('title', 'Status Keseluruhan')
        @if ($booking->overall_status_id == 2)
          <div class="card horizontal green white-text">
            <div class="card-content">
              <strong>
                {{$booking->overall_status}}
              </strong>
            </div>
          </div>
        @elseif ($booking->overall_status_id == 3)
          <div class="card horizontal red white-text">
            <div class="card-content">
              <strong>
                {{$booking->overall_status}}
              </strong>
            </div>
          </div>
        @else 
          <div class="card horizontal orange">
            <div class="card-content">
              <strong>
                {{$booking->overall_status}}
              </strong>
            </div>
          </div>
        @endif
      @endcomponent 

      @component('status.detail_div')
        @slot('title','Breakdown Status')
        <strong>
          {{$booking_details->where('booking_status_id', 2)->count()}} DITERIMA <br>
        </strong>
        <strong>
          {{$booking_details->where('booking_status_id', 3)->count()}} DITOLAK <br>
        </strong>
        <strong>
          {{$booking_details->where('booking_status_id', 1)->count()}} MENUNGGU <br>
        </strong>
      @endcomponent

      @if (Auth::check() && Auth::user()->hasRole('manage_room'))
        @component('status.detail_div')
          @slot('title', 'Ubah Status Semua')
          <div class="col s12">
            <button class="btn waves-effect waves-light red modal-trigger" data-target="reject_all" onclick="fill_modal('reject_all', '{{ $booking->id }}','')"> 
              Tolak Semua
            </button>
            <button class="btn waves-effect waves-light green modal-trigger" data-target="accept_all" onclick="fill_modal('accept_all', '{{ $booking->id }}','')"> 
              Terima Semua
            </button>
          </div>
        @endcomponent

        @component('status.detail_div')
          @slot('title', 'Aksi Lainnya')
          <div class="col s12">
            <button class="btn waves-effect waves-light blue modal-trigger" data-target="add_detail" onclick="fill_modal('add_detail', '{{$booking->id}}', '')">
              Tambah Detail
            </button>
          </div>
        @endcomponent
      @endif

      <table class="responsive-table highlight centered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Ruangan</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Status</th>
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
              <td>{{$detail->booking_status_name}}</td>
              @if (Auth::check())
                <td>
                  <div class="row">
                    <div class="col s12">
                      <button class="btn waves-effect waves-light blue modal-trigger right" data-target="edit_detail" onclick="
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
    @endif
  </div>

  @if (Auth::check() && Auth::user()->hasRole('manage_room'))
    @component('status.detail_modal')
      @slot('modal_id', 'accept_id')
      @slot('title', 'Konfirmasi Penerimaan')
      @slot('content', 'Apakah anda yakin ingin menerima detail reservasi ini ?')
      @slot('routing')
        {{url('/reserve/status/accept')}}
      @endslot
      @slot('button_class', 'green')
      @slot('button', 'Terima')
    @endcomponent

    @component('status.detail_modal')
      @slot('modal_id', 'reject_all')
      @slot('title', 'Konfirmasi Penolakan Seluruh Reservasi')
      @slot('content', 'Apakah anda yakin ingin menolak / membatalkan seluruh reservasi ini ?')
      @slot('routing') 
        {{url('/reserve/status/reject_all')}} 
      @endslot
      @slot('button_class', 'red')
      @slot('button', 'Tolak Semua')
    @endcomponent

    @component('status.detail_modal')
      @slot('modal_id', 'accept_all')
      @slot('title', 'Konfirmasi Penerimaan Seluruh Reservasi')
      @slot('content', 'Apakah anda yakin ingin menerima seluruh reservasi ini ?')
      @slot('routing') 
        {{url('/reserve/status/accept_all')}} 
      @endslot
      @slot('button_class', 'green')
      @slot('button', 'Terima Semua')
    @endcomponent

    @component('status.detail_modal')
      @slot('modal_id', 'delete_detail')
      @slot('title', 'Konfirmasi Penghapusan Detail Reservasi')
      @slot('content', 'Apakah anda yakin ingin menghapus detail reservasi ini ?')
      @slot('routing')
        {{url('/reserve/status/delete')}}
      @endslot
      @slot('button_class', 'red')
      @slot('button', 'Hapus Detail')
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
              <input type="text" class="datepicker" id="start_date" name="start_date" class="validate" required>
              <span class="helper-text">
                Pilih Tanggal Acara Anda (Format: YYYY-MM-DD)
                <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan hari yang anda pilih sesuai dengan syarat dan ketentuan">help</i>
              </span>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12 m6">
              <i class="material-icons prefix">access_time</i>
              <input type="text" class="timepicker" id="start_time" name="start_time" class="validate" required>
              <span class="helper-text">
                Pilih Waktu Mulai Acara
                <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan waktu yang anda pilih sesuai dengan syarat dan ketentuan">help</i>
              </span>
            </div>
            <div class="input-field col s12 m6">
              <i class="material-icons prefix"></i>
              <input type="text" class="timepicker" id="end_time" name="end_time" class="validate" required>
              <span class="helper-text">
                Pilih Waktu Selesai Acara
                <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan waktu yang anda pilih sesuai dengan syarat dan ketentuan">help</i>
              </span>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">check_circle_outline</i>
              <select name="status">
                <option value="1" selected>MENUNGGU</option>
                <option value="2">TERIMA</option>
                <option value="3">TOLAK</option>
              </select>

              <label for="status">Status</label>
              <span class="helper-text">
                Ganti status detail
                <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pilihan status secara default adalah Menunggu">help</i>
              </span>
            </div>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <a class="btn waves-effect waves-light grey modal-close">
          Kembali
        </a>
        <button class="btn waves-effect waves-light blue" onclick="submit_form('form_edit_detail')">
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
              <input type="text" class="datepicker" id="start_date" name="start_date" class="validate" required>
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
              <input type="text" class="timepicker" id="start_time" name="start_time" class="validate" required>
              <label for="start_time">Waktu Mulai</label>
              <span class="helper-text">
                Pilih Waktu Mulai Acara
                <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan waktu yang anda pilih sesuai dengan syarat dan ketentuan">help</i>
              </span>
            </div>
            <div class="input-field col s12 m6">
              <i class="material-icons prefix"></i>
              <input type="text" class="timepicker" id="end_time" name="end_time" class="validate" required>
              <label for="end_time">Waktu Selesai</label>
              <span class="helper-text">
                Pilih Waktu Selesai Acara
                <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan waktu yang anda pilih sesuai dengan syarat dan ketentuan">help</i>
              </span>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">check_circle_outline</i>
              <select name="status">
                <option value="1" selected>MENUNGGU</option>
                <option value="2">TERIMA</option>
                <option value="3">TOLAK</option>
              </select>

              <label for="status">Status</label>
              <span class="helper-text">
                Ganti status detail
                <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pilihan status secara default adalah Menunggu">help</i>
              </span>
            </div>
          </div>

          <div class="row">
            <div class="col s12">
              <button class="btn waves-effect waves-light right" type="submit">
                Tambah <i class="material-icons right">send</i>
              </button>
              <button class="btn waves-effect waves-light right grey modal-close" style="margin-right:0.3rem">
                Kembali
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  @endif

  {{$booking_details->links()}}
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
      $('#edit_detail select[name="status"]').val(status);
      $('select').formSelect();
    }

    $(document).ready(function(){
      $('.modal').modal();
      $('select').formSelect();
      $("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
      });
      $('.timepicker').timepicker({
        twelveHour: false,
      });
      $('.tooltipped').tooltip();

    })
  </script>
@endsection