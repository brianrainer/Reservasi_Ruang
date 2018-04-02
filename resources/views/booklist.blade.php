@extends('master')

@section('title')
  Book Listing
@endsection

@section('content')
  <h2>Book Listing</h2>

  <div>
    @if ($bookings->count())
      <table class="centered striped responsive-table">
        <thead>
          <tr>
            <td>Booking ID</td>
            <td>Event Title</td>
            <td>Event Start</td>
            <td>Event Duration</td>
            <td>Name</td>
            <td>Status</td>
          </tr>
        </thead>
        <tbody>
          @foreach ($bookings as $b)
            <tr>
              <td>{{ $b->booking_id }}</td>
              <td>{{ $b->event_title }}</td>
              <td>{{ $b->start }}</td>
              <td>{{ $b->duration }}</td>
              <td>{{ $b->name }}</td>
              <td>{{ $b->accept }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $bookings->links() }}
    @else
      <div>
        Book Listing not Found.
      </div>
    @endif
  </div>
@endsection

@section('jsScripts')
  {{-- expr --}}
@endsection