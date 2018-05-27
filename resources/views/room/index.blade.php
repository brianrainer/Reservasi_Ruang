@extends('layouts.master')

@section('title', 'Ruangan')

@section('content')
  <h1>Ruangan</h1>
  <div>
    @if ($rooms->count())
      <div class="row">
        @foreach ($rooms as $room)

          <div class="col s12 m6 l4">
            <div class="card">
              <div class="card-image waves-effect waves-block waves-light">
                @if ($room->room_imagepath)
                  <img src="{{$room->room_imagepath}}">
                @endif
              </div>
              <div class="card-content">
                <span class="card-title activator gray-text text-darken-4">{{ $room->room_name }}<i class="material-icons right">more_vert</i>
                </span>
                <p>
                  <a href="{{url('/room/'.$room->code)}}">Check Status</a>
                </p>
                <p>
                  <a href="{{url('/room/edit/'.$room->code)}}">Edit Room</a>
                </p>
              </div>
              <div class="card-reveal">
                <span class="card-title activator gray-text text-darken-4">{{ $room->room_name }}<i class="material-icons right">close</i>
                </span>
                {{-- 
                <p>
                  {{ $room->technicians() }}
                </p>
                 --}}  
              </div>
            </div>
          </div>

        @endforeach
      </div>
    @else
      No room found
    @endif
  </div>
@endsection