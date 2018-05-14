@extends('master')

@section('title')
  Book Listing
@endsection

@section('sccScripts')
  <style type="text/css">
  
  </style>
@endsection

@section('content')
  <h2>Book Listing</h2>

  <div>
    @if ($bookings->count())
      <table width="100%" class="centered striped responsive-table fit-in-div">
        <thead>
          <tr>
            <th>Booking ID</th>
            <th>Event Start</th>
            <th>Event Duration</th>
            <th>Event Title</th>
            <th>Event Description</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Agencies</th>
            <th>Status</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($bookings as $b)
            <tr>
              <td>{{ $b->booking_id }}</td>
              <td>{{ $b->start }}</td>
              <td>{{ $b->duration }} min</td>
              <td>{{ $b->event_title }}</td>
              <td>{{ $b->event_desc }}</td>
              <td>{{ $b->name }}</td>
              <td>
                <div>
                  {{ $b->phone_number}}
                </div>
              </td>
              <td>
                <div>
                  {{ $b->email }}
                </div>
              </td>
              <td>{{ $b->agencies }}</td>
              <td>{{ $b->accept }}</td>
              <td>
                <a href="#" class="btn waves-effect waves-light">
                  <i class="material-icons left">edit</i>
                </a>
              </td>
              <td>
                <a href="#" class="btn waves-effect waves-light red">
                  <i class="material-icons left">delete</i>
                </a>
              </td>
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