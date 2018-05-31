@extends('layouts.master')

@section('title','ReservasiTC | Detail')

@section('content')
  <h1>Detail Reservasi</h1>
  @include('layouts.status')
  @include('layouts.errors')

  <table class="responsive-table">
    <thead></thead>
    <tbody>
      @foreach ($bookings as $booking)
        <tr>
          <th>Nomer Booking</th>
          <td>{{$booking->id}}</td>
        </tr>
        <tr>
          <th>Peminjam</th>
          <td>{{$booking->name}}</td>
        </tr>
        <tr>
          <th>Perwakilan dari Organisasi</th>
          <td>{{$booking->agency_name}}</td>
        </tr>
        <tr>
          <th>Judul Kegiatan</th>
          <td>{{$booking->event_title}}</td>
        </tr>
        <tr>
          <th>Deskripsi Kegiatan</th>
          <td>{{$booking->event_description}}</td>
        </tr>
        <tr>
          <th>Kategori Kegiatan</th>
          <td>{{$booking->category}}</td>
        </tr>
        @foreach ($booking_details as $detail)
          <tr>
            <th>Lokasi dan Waktu</th>
            <td>
              {{$detail->room_name}}
              {{$detail->event_start}}
              {{$detail->event_end}}
            </td>
          </tr>
        @endforeach
      @endforeach
    </tbody>
    <tfoot></tfoot>
  </table>
@endsection