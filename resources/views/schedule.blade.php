@extends('master')

@section('title')
  Schedule Listing
@endsection

@section('cssScripts')
  {{-- expr --}}
@endsection

@section('content')
  <h2>Schedule Listing</h2>

  <div>
    @if ($schedule->count())
      <table class="centered striped responsive-table">
        <thead>
          <tr>Schedule ID</tr>
          <tr>Booking ID</tr>
          <tr>Room ID</tr>
          <tr>Start</tr>
          <tr>End</tr>
        </thead>
        <tbody>
          @foreach ($schedules as $s)
            <tr>
              <td>{{ $s->schedule_id }}</td>
              <td>{{ $s->booking_id }}</td>
              <td>{{ $s->room_id }}</td>
              <td>{{ $s->start }}</td>
              <td>{{ $s->end }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $schedule->links() }}
    @else
      <div>
        Schedule Listing not Found.
      </div>
    @endif
  </div>
@endsection

@section('jsScripts')
  {{-- expr --}}
@endsection