@extends('layouts.master')

@section('title', 'Ruangan')

@section('content')
  <h1>Ruangan</h1>
  <div>
    @if ($class_rooms->count() || $teachers_rooms->count() || $other_rooms->count())
      @if ($class_rooms->count())
        <h4>Ruang Kelas</h4>
        <div class="row">
          @foreach ($class_rooms as $room)
            @include('room.room-div')
          @endforeach
        </div>
      @endif
      @if ($teachers_rooms->count())
        <h4>Ruang Dosen</h4>
        <div class="row">
          @foreach ($teachers_rooms as $room)
            @include('room.room-div')
          @endforeach
        </div>
      @endif
      @if ($other_rooms->count())
        <h4>Lain-Lain</h4>
        <div class="row">
          @foreach ($other_rooms as $room)
            @include('room.room-div')
          @endforeach
        </div>
      @endif
    @else
      <div class="card-panel red">
        Data Ruangan Belum Ada
      </div>
    @endif
  </div>
@endsection