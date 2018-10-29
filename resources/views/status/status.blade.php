@extends('layouts.master')

@section('title', 'ReservasiTC | Status')

@section('content')
  <div class="container" style="width:80%">
  <h1>Status Reservasi</h1>
  @include('layouts.status')
  @include('layouts.errors')

  @if (session('message'))
    <div class="card-panel teal">
      {{session('message')}}
    </div>
  @endif
  <div class="row">
    <form action="{{url('/reserve/status')}}" method="GET">
      <div class="input-field col s3 m3 l3">
        <input type="text" name="peminjam" id="name-search" class="automplete" value="{{app('request')->input('peminjam')}}">
        <label for="name-search">Nama Peminjam</label>
      </div>
      <div class="input-field col s3 m3 l3">
        <input type="text" name="kegiatan" id="kegiatan-search" class="automplete" value="{{app('request')->input('kegiatan')}}">
        <label for="kegiatan-search">Nama Kegiatan</label>
      </div>
      <div class="input-field col s2 m2 l2">
        <select name="status" value="3">
          <option value="">SEMUA</option>
          <option value="2">DITERIMA</option>
          <option value="1">MENUNGGU</option>
          <option value="3">DITOLAK</option>
        </select>
        <label>Status</label>
      </div> 
      <div class="input-field col">
        <button class="waves-effect waves-light btn blue darken-3" type="submit"><i class="material-icons left">search</i>Search</button>
      </div>
    </form>
  </div>
  @if ($bookings->count())
    
    <table class="responsive-table">
      <thead>
        <tr>
          <th>No</th>
          <th>Peminjam</th>
          <th>Judul Kegiatan</th>
          <th>Dibuat</th>
          <th>Status</th>
          <th>Detail</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($bookings as $booking)
          <tr>
            <td>{{$booking->id}}</td>
            <td>{{$booking->name}}</td>
            <td>{{$booking->event_title}}</td>
            <td>{{ \Carbon\Carbon::parse($booking->created_at)->format('l jS \\of F Y H:i:s')}}</td>
            <td>{{$booking->status}}</td>
            <td>
              <a href="{{url('reserve/status/'.$booking->id)}}" class="btn btn-primary blue darken-3">Detail</a>
            </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot></tfoot>
    </table>
    {{$bookings->appends(app('request')->except('page'))->links()}}
  @else 
    <div class="card-panel red">
      Belum Ada Reservasi
    </div>
  @endif
  </div>
@endsection

@section('js')
  <script type="text/javascript">
    $(document).ready(function(){
      $('select').formSelect();
    });
  </script>
@endsection
