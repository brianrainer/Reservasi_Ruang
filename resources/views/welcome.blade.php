
@extends('layouts.master')

@section('title', 'ReservasiTC | Welcome')

@section('content')
  <div class="center">
    <h1>
      <strong id="time"></strong>
      <h5 id="day"></h5>
    </h1>
    <div class="row" style="padding:30px;">
      <div id="calendar"></div>
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
  <script type="text/javascript">
    $(document).ready(function(){
      $('#calendar').fullCalendar({
        eventSources : [
          {
            url: 'calendar/accepted',
            color: 'green',
            textColor: 'white',
            borderColor: 'black',
            cache: true
          },
        ],
        timeFormat: 'H:mm'
      })
    });
  </script>
@endsection
