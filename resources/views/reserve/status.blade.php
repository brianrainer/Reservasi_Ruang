@extends('layouts.master')

@section('title', 'ReservasiTC | Status')

@section('content')
  <h1>Status Reservasi</h1>

  @if ($bookings->count())
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Peminjam</th>
        <th>Judul Kegiatan</th>
        <th>Dibuat</th>
        <th>Details</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($bookings as $booking)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$booking->name}}</td>
          <td>{{$booking->event_title}}</td>
          <td>{{$booking->created_at}}</td>
          <td>
            <a href="" class="btn btn-primary">Details</a>
          </td>
          <td>
          </td>
        </tr>
      @endforeach
    </tbody>
    <tfoot></tfoot>
  </table>
  @endif
@endsection