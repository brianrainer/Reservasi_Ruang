@extends('layouts.master')

@section('title', 'Ruangan')

@section('content')
  <div class="container" style="width:80%">
    <h1>Ruangan</h1>
    <div>
      @include('layouts.status')
      @include('layouts.errors')

      @if (Auth::check())
        <div class="row">
          <a href="{{url('/room/create')}}" class="btn btn-primary waves-effect waves-light blue darken-4">Tambah Ruangan</a>
        </div>
      @endif
      @if ($rooms->count())
        <table class="responsive-table centered">
          <thead>
            <tr>
              <th>Kode</th>
              <th>Nama Ruangan</th>
              <th>Jadwal</th>
              <th>Detail Ruangan</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($rooms as $room)
              <tr>
                <td>{{$room->room_code}}</td>
                <td>{{$room->room_name}}</td>
                <td>
                  <a class="btn waves-effect waves-light blue darken-4" href="{{url('/agenda/'.$room->room_code)}}">Agenda</a>
                </td>
                <td>
                  <a class="btn waves-effect waves-light blue darken-4" href="{{url('/room/detail/'.$room->room_code)}}">Detail</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{$rooms->render()}}
      @else
        <div class="card-panel red">
          Data Ruangan Belum Ada
        </div>
      @endif 
    </div>
  </div>
@endsection