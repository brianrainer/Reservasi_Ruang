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
        {{$booking->id}}
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

      @if (Auth::check() && Auth::user()->hasRole('manage_room'))
        @component('status.detail_div')
          @slot('title', 'Ubah Semua')
          <div class="col s12">
            <button class="btn waves-effect waves-light red modal-trigger" data-target="reject_all" onclick="fill_modal('reject_all', '{{ $booking->id }}','')"> 
              Tolak Semua
            </button>
            <button class="btn waves-effect waves-light green modal-trigger" data-target="accept_all" onclick="fill_modal('accept_all', '{{ $booking->id }}','')"> 
              Terima Semua
            </button>
          </div>
        @endcomponent
      @endif

      @foreach ($booking_details as $detail)
        @component('status.detail_div')
          @slot('title')
            Waktu dan Lokasi #{{$loop->iteration}}
          @endslot
            <div class="col s12">
              {{$detail->room_code}} ({{$detail->room_name}})
            </div>
            <div class="col s12">
              {{ \Carbon\Carbon::parse($detail->event_start)->format('l, jS \\of F Y H:i') }} to {{ \Carbon\Carbon::parse($detail->event_end)->format('H:i') }}</div>
            <div class="col s12">
              <strong>    
                Status: 
              </strong>
              {{$detail->booking_status_name}}
            </div>
          @if (Auth::check() && Auth::user()->hasRole('manage_room'))
            <div class="col s12">
              <button class="btn waves-effect waves-light green modal-trigger" data-target="accept_id" onclick="fill_modal('accept_id', '{{ $booking->id }}', '{{ $detail->id }}')"> 
                Terima
              </button>
              
              <button class="btn waves-effect waves-light blue modal-trigger" data-target="edit_detail" onclick="fill_modal('edit_detail', '{{ $booking->id }}', '{{ $detail->id }}')"> 
                Edit
              </button>
            </div>
          @endif
        @endcomponent
      @endforeach
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
      @slot('modal_id', 'edit_detail') 
      @slot('title', 'Edit Detail Reservasi')
      @slot('content', 'Detail Reservasi')
      @slot('routing')
        {{url('/reserve/status/edit')}}
      @endslot
      @slot('input')
      <div>
        @include('reserve.form-one-room')
        @include('reserve.form-time')
      </div>
      @endslot
      @slot('button_class', 'blue')
      @slot('button', 'Edit')
    @endcomponent
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

    $(document).ready(function(){
      $('.modal').modal();
    })
  </script>

  @include('reserve.form-js')
@endsection