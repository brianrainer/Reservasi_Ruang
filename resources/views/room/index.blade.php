@extends('layouts.master')

@section('title', 'Ruangan')

@section('content')
  <div class="container" style="width:80%">
    <h1>Ruangan</h1>
    <div>
      @include('layouts.status')
      @include('layouts.errors')

      @if (Auth::check() && Auth::user()->hasRole('manage_room'))
        <div class="row">
          <a href="{{url('/room/create')}}" class="btn btn-primary waves-effect waves-light blue darken-4">Tambah Ruangan</a>
        </div>
      @endif
      @if ($rooms->count())
        <div class="row">
          @foreach ($rooms as $room)
            @include('room.room-div')
          @endforeach
        </div>
      @else
        <div class="card-panel red">
          Data Ruangan Belum Ada
        </div>
      @endif 
    </div>
  </div>
@endsection
