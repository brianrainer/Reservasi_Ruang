@extends('layouts.master')

@section('title', 'Detail Ruangan')

@section('content')
  <div class="container" style="width:80%">
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
        @foreach ($technicians as $t)
          {{ $t->name }} {{ $t->phone}} <br>
        @endforeach
      @endcomponent

      @component('status.detail_div')
        @slot('title')
          Cek Status Ruangan
        @endslot
        <a href="{{url('/agenda/'.$room->room_code)}}" class="btn waves-effect waves-light green">Agenda</a>
      @endcomponent

      @component('status.detail_div')
        @slot('title')
          Gambar Ruangan
        @endslot
        @if ($room->room_imagepath)
          <div class="card col s6">
            <div class="card-image">
              <img src="{{asset($room->room_imagepath)}}">
            </div>
          </div>
        @else
          Gambar belum ada
        @endif
      @endcomponent
      
      @if(Auth::check() && Auth::user()->hasRole('manage_room'))
        @component('status.detail_div')
          @slot('title')
            Edit Detail Ruangan
          @endslot
          <div>
            <a href="{{url('/room/edit/'.$room->room_id)}}" class="btn waves-effect waves-light orange">Edit</a>
          </div>
        @endcomponent
      @endif
    @endif
  </div>
  </div>
@endsection
