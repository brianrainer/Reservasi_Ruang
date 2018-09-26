@extends('layouts.master')

@section('title', 'ReservasiTC | Kalender')

@section('content')
  <div class="container" style="width:80%">
    <div class="row" style="padding:30px;">
      <div id="calendar"></div>
    </div>
  </div>
@endsection

@section('js')
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
          }
        ],
        timeFormat: 'H:mm'
      })
    });
  </script>
@endsection
