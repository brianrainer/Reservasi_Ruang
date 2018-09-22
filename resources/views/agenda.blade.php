@extends('layouts.master')

@section('title', 'ReservasiTC | Agenda')

@section('content')
  <style>
  div.box {
    margin: auto;
    border-style: solid;
    border-radius: 15px;
    border-width: 5px;
  }
  </style>
  <div class="row">
    <div class="col">
      <h2>
        <strong id="time"></strong>
        <h5 id="day"></h5>
      </h2>
    </div>
  </div>
  <div class="row">
    @isset ($room_code)  
      <div class="col s8 m8 l8 offset-s2 offset-m2 offset-l2 box" id="eventbox" style="text-align: center">
        <h5>{{$room_code}}</h5>
        <h3><strong id="now"></strong></h3>
        <h5 id="status"></h5>
      </div>
    @endisset

  </div>
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
        }
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
      @endisset
      
      $('#calendar').fullCalendar({
        header: { 
          left: 'today prev,next',
          right: 'agendaDay, agendaWeek'
        },
        defaultView: 'agendaDay',
        height: 'auto',
        minTime: '06:00:00',
        eventSources : calendarEvent, 
        nowIndicator: true,
      })
    });
  </script>
  <script type="text/javascript">
    function update(){
      var day = moment().format('dddd, Do of MMM YYYY');
      var time = moment().format('HH:mm:ss');
      
      @isset($room_code)
      $.get('/calendar/status?roomCode=' + '{{$room_code}}' + '&time=' + moment().format(), function(data){
          if (data){
            $('#now').html(data);
            $('#status').html('Ruangan sedang dipakai');
            document.getElementById('eventbox').style.backgroundColor = '#e53935';
            document.getElementById('eventbox').style.borderColor = '#d32f2f';
          }
          else {
            $('#now').html('-');
            $('#status').html('Ruangan kosong');
            document.getElementById('eventbox').style.backgroundColor = '#9e9e9e';
            document.getElementById('eventbox').style.borderColor = '#757575';
          }
        });
      @else
      $.get('/calendar/status?'+ '&time=' + moment().format(), function(data){
          if (data){
            $('#now').html(data);
            $('#status').html('Ruangan sedang dipakai');
            document.getElementById('eventbox').style.backgroundColor = '#e53935';
            document.getElementById('eventbox').style.borderColor = '#d32f2f';
          }
          else {
            $('#now').html('-');
            $('#status').html('Ruangan kosong');
            document.getElementById('eventbox').style.backgroundColor = '#9e9e9e';
            document.getElementById('eventbox').style.borderColor = '#757575';
          }
        });
      @endisset
      
      $('#day').html(day);
      $('#time').html(time);
    }

    setInterval(update, 1000);
  </script>
@endsection
