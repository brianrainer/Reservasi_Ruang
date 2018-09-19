@extends('layouts.master')

@section('title','ReservasiTC | Detail')

@section('content')
  <h1>Detail Reservasi</h1>
  @include('layouts.status')
  @include('layouts.errors')

  <div class="row">
    @if ($booking)
      @component('status.detail_div')
        @slot('title')
          Nomor Reservasi
        @endslot
        {{$booking->id}}
      @endcomponent

      @component('status.detail_div')
        @slot('title')
          Peminjam
        @endslot
        {{$booking->name}}
      @endcomponent

      @if (Auth::check() && Auth::user()->hasRole('manage_room'))
        @if (!empty($booking->nrp_nip))
          @component('status.detail_div')
            @slot('title')
              NRP / NIP
            @endslot
            {{$booking->nrp_nip}}
          @endcomponent
        @endif

        @component('status.detail_div')
          @slot('title')
            Email
          @endslot
          {{$booking->email}}
        @endcomponent

        @component('status.detail_div')
          @slot('title')
            Nomor Telepon
          @endslot
          {{$booking->phone_number}}
        @endcomponent
      @endif

      @component('status.detail_div')
        @slot('title')
          Perwakilan
        @endslot
        {{$booking->agency_name}}
      @endcomponent

      @component('status.detail_div')
        @slot('title')
          Judul Kegiatan
        @endslot
        {{$booking->event_title}}
      @endcomponent

      @component('status.detail_div')
        @slot('title')
          Kategori Kegiatan
        @endslot
        {{$booking->category_name}}
      @endcomponent

      @component('status.detail_div')
        @slot('title')
          Deskripsi Kegiatan
        @endslot
        {{$booking->event_description}}
      @endcomponent

      @if (Auth::check() && Auth::user()->hasRole('manage_room'))
        @component('status.detail_div')
          @slot('title')
            Tolak/Terima Semua
          @endslot
            <div class="col s12">
              <button class="btn waves-effect waves-light red modal-trigger" data-target="reject_all" onclick="fill_modal('reject_all', '{{ $booking->id }}','')"> 
                Tolak Semua
              </button>
              <button class="btn waves-effect waves-light orange modal-trigger" data-target="pending_all" onclick="fill_modal('pending_all', '{{ $booking->id }}','')"> 
                Pending Semua
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
              <button class="btn waves-effect waves-light red modal-trigger" data-target="reject_id" onclick="fill_modal('reject_id', '{{ $booking->id }}', '{{ $detail->id }}')"> 
                Tolak
              </button>
              <button class="btn waves-effect waves-light orange modal-trigger" data-target="pending_id" onclick="fill_modal('pending_id', '{{ $booking->id }}', '{{ $detail->id }}')"> 
                Pending
              </button>
              <button class="btn waves-effect waves-light green modal-trigger" data-target="accept_id" onclick="fill_modal('accept_id', '{{ $booking->id }}', '{{ $detail->id }}')"> 
                Terima
              </button>
              
              <a href="{{url('/reserve/status/edit/'.$detail->id)}}" class="btn waves-effect waves-light blue">Edit</a>
            </div>
          @endif
        @endcomponent
      @endforeach
    @endif
  </div>

  @if (Auth::check() && Auth::user()->hasRole('manage_room'))
    @component('status.detail_modal')
      @slot('modal_id') reject_id @endslot
      @slot('title') Konfirmasi Penolakan @endslot
      @slot('content') 
        Apakah anda yakin ingin menolak / membatalkan detail reservasi ini ?
      @endslot
      @slot('routing') {{url('/reserve/status/reject')}} @endslot
      @slot('button_class') red @endslot
      @slot('button') Tolak @endslot
    @endcomponent

    @component('status.detail_modal')
      @slot('modal_id') accept_id @endslot
      @slot('title') Konfirmasi Penerimaan @endslot
      @slot('content') 
        Apakah anda yakin ingin menerima detail reservasi ini ?
      @endslot
      @slot('routing') {{url('/reserve/status/accept')}} @endslot
      @slot('button_class') green @endslot
      @slot('button') Terima @endslot
    @endcomponent

    @component('status.detail_modal')
      @slot('modal_id') pending_id @endslot
      @slot('title') Konfirmasi Pending @endslot
      @slot('content') 
        Apakah anda yakin ingin mengubah detail reservasi ini menjadi menunggu ?
      @endslot
      @slot('routing') {{url('/reserve/status/pending')}} @endslot
      @slot('button_class') orange @endslot
      @slot('button') Terima @endslot
    @endcomponent

    @component('status.detail_modal')
      @slot('modal_id') reject_all @endslot
      @slot('title') Konfirmasi Penolakan Seluruh Reservasi @endslot
      @slot('content') 
        Apakah anda yakin ingin menolak / membatalkan seluruh reservasi ini ?
      @endslot
      @slot('routing') {{url('/reserve/status/reject_all')}} @endslot
      @slot('button_class') red @endslot
      @slot('button') Tolak Semua @endslot
    @endcomponent

    @component('status.detail_modal')
      @slot('modal_id') accept_all @endslot
      @slot('title') Konfirmasi Penerimaan Seluruh Reservasi @endslot
      @slot('content') 
        Apakah anda yakin ingin menerima seluruh reservasi ini ?
      @endslot
      @slot('routing') {{url('/reserve/status/accept_all')}} @endslot
      @slot('button_class') green @endslot
      @slot('button') Terima Semua @endslot
    @endcomponent

    @component('status.detail_modal')
      @slot('modal_id') pending_all @endslot
      @slot('title') Konfirmasi Pending Seluruh Reservasi @endslot
      @slot('content') 
        Apakah anda yakin ingin mengubah seluruh status reservasi ini menjadi menunggu ?
      @endslot
      @slot('routing') {{url('/reserve/status/pending_all')}} @endslot
      @slot('button_class') orange @endslot
      @slot('button') Pending Semua @endslot
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
@endsection