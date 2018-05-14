@extends('master')

@section('title')
  Room Dashboard
@endsection

@section('cssScripts')
  {{-- expr --}}
@endsection

@section('content')
  <h2>Room Dashboard</h2>

  <div>
    @if ($rooms->count())
      <div class="row">
        @foreach ($rooms as $r)
          <div class="col s12 m6 l4">
            <div class="card">
              <div class="card-image waves-effect waves-block waves-light">
                <img src="images/sample-1.jpg">
              </div>
              <div class="card-content">
                <span class="card-title activator gray-text text-darken-4">{{ $r->room_name }}<i class="material-icons right">more_vert</i>
                </span>
                <p>
                  <a href="#">Check Status</a>
                </p>
              </div>
              <div class="card-reveal">
                <span class="card-title activator gray-text text-darken-4">{{ $r->room_name }}<i class="material-icons right">close</i>
                </span>
                <p>
                  {{ $r->tech_id }}
                </p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div>
        Rooms Not Found.
      </div>
    @endif
  </div>

  <div>
    <div class="row">
      <div class="col s12 m6 l4">
        <div class="card">
          <div class="card-image waves-effect waves-block waves-light">
            <img class="activator" src="images/sample-1.jpg">
          </div>
          <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">Room IF-103<i class="material-icons right">more_vert</i></span>
            <p><a href="#">Check Status</a></p>
          </div>
          <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Room IF-103<i class="material-icons right">close</i></span>
            <p>Here is some more information about this product that is only revealed once clicked on.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('jsScripts')
  {{-- expr --}}
@endsection