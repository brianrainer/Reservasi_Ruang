
@extends('layouts.master')

@section('title', 'ReservasiTC | Welcome')

@section('content')
    <div class="center">
        <h1>
            <strong id="time"></strong>
            <h5 id="day"></h5>
        </h1>

        <div class="container">
            <ul>
                @foreach ($bookings as $booking)
                    <li>
                        <div class="card-panel lime accent-1">
                        <ul>
                            <li>{{ $booking->event_title }}</li>
                            <li>{{ $booking->room_code }} ({{ $booking->room_name }})</li>
                            <li>{{ \Carbon\Carbon::parse($booking->event_start)->format('H:i') }} s/d {{ \Carbon\Carbon::parse($booking->event_end)->format('H:i') }}</li>
                        </ul>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function update(){
            var day = moment().format('dddd, Do of MMM YYYY');
            var time = moment().format('HH:mm:ss');
            $('#day').html(day);
            $('#time').html(time);
        }

        setInterval(update, 1000);
    </script>
@endsection