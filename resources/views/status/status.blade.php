@extends('layouts.master')

@section('title', 'ReservasiTC | Status')

@section('content')
  <h1>Status Reservasi</h1>
  @include('layouts.status')
  @include('layouts.errors')

  @if (session('message'))
    <div class="card-panel teal">
      {{session('message')}}
    </div>
  @endif

  @if ($bookings->count())
  <table class="responsive-table">
    <thead>
      <tr>
        <th>No</th>
        <th>Peminjam</th>
        <th>Judul Kegiatan</th>
        <th>
            Dibuat
            {{-- todo: buat orderby sama search --}}
            <button type="submit" class="btn btn-small btn-flat waves-light">
              <i class="material-icons">arrow_drop_down</i>
            </button>
        </th>
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
          <td>
            <a href="{{url('reserve/status/'.$booking->id)}}" class="btn btn-primary">Detail</a>
          </td>
        </tr>
      @endforeach
    </tbody>
    <tfoot></tfoot>
  </table>
  @endif
@endsection