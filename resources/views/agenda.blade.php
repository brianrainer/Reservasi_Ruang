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
      var calendarEvent = [
        {
          url: '/calendar/accepted',
          color: 'green',
          textColor: 'white',
          borderColor: 'black',
          cache: true
        },{
          url: '/calendar/waiting',
          color: 'orange',
          textColor: 'white',
          borderColor: 'black',
          cache: true
        },{
          url: '/calendar/rejected',
          color: 'red',
          textColor: 'white',
          borderColor: 'black',
          cache: true
        },
      ];

      @isset ($room_code)
        calendarEvent = [
          {
            url: '/calendar/accepted/' + '{{$room_code}}',
            color: 'green',
            textColor: 'white',
            borderColor: 'black',
            cache: true 
          }
        ]
      @endif
      
      $('#calendar').fullCalendar({
        defaultView: 'listDay',
        eventSources : calendarEvent, 
        nowIndicator: true,
      })
    });
  </script>
@endsection
