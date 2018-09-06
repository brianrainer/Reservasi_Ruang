@extends('layouts.master')

@section('title', 'Detail Ruangan')

@section('content')
  <h1>Detail Ruangan</h1>
  @include('layouts.status')
  @include('layouts.errors')

  <div class="row">
    @if($room)
      @component('status.detail_div')
        @slot('title')
          Kode Ruangan
        @endslot
        {{$room->room_code}}
      @endcomponent

      @component('status.detail_div')
        @slot('title')
          Nama Ruangan
        @endslot
        {{$room->room_name}}
      @endcomponent

      @component('status.detail_div')
        @slot('title')
          Teknisi
        @endslot
        {{$room->technician}} <br>
        {{$room->phone}}
      @endcomponent

      @if($room->room_imagepath)
        @component('status.detail_div')
          @slot('title')
            Gambar Ruangan
          @endslot
          <img src="{{$room->room_imagepath}}">
      @endif
    @endif
  </div>
  <div>

  </div>
@endsection