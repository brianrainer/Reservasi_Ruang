@extends('layouts.master')

@section('title', 'ReservasiTC | Kalender')

@section('content')
  <div class="row" style="padding:30px;">
    <div id="calendar"></div>
  </div>
@endsection

@section('js')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#calendar').fullCalendar({
        defaultView: 'agendaDay',
        eventSources : [
          {
            url: 'calendar/accepted',
            color: 'green',
            textColor: 'white',
            borderColor: 'black',
            cache: true
          },{
            url: 'calendar/waiting',
            color: 'orange',
            textColor: 'white',
            borderColor: 'black',
            cache: true
          },{
            url: 'calendar/rejected',
            color: 'red',
            textColor: 'white',
            borderColor: 'black',
            cache: true
          },
        ],
        nowIndicator: true,
      })
    });
  </script>
@endsection