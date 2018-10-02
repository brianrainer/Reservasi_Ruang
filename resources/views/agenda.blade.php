@extends('layouts.master')

@section('title', 'ReservasiTC | Agenda')

@section('css')
  <style>
    .box {
      margin: auto;
      border-style: solid;
      border-radius: 5px;
      border-width: 5px;
    }
    .free-room {
      border-color: #ffb300;
    }
    .used-room {
      border-color: #b71c1c; 
    }
  </style>
@endsection

@section('content')
  <div class="container" style="width:80%">
    <div class="row" style="padding:20px">
    @isset ($room_code)  
      <div class="col s12 m12 l12 box" id="eventbox" style="text-align: center">
        <div class="row" id="eventtitle">
          <div class="col s12 m12 l12">
            <h4 class="center-align"><strong>{{$room_code}}</strong></h4>
          </div>
        </div>
        <div class="row">
          <div class="col s3 m3 l3">
            <h5><strong id="time"></strong></h4>
            <h5 id="day"></h4>
          </div>
          <div class="col s9 m9 l9">
            <h3><strong id="now"></strong></h3>
            <h5 id="status"></h5>
          </div>
        </div>
      </div>
    @endisset
    </div>
    <div class="row" style="padding:20px;">
      <div id="calendar"></div>
    </div>
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
      
      $('#day').html(day);
      $('#time').html(time);
    }

    setInterval(update, 1000);

    function update_board(){
      @isset($room_code)
        $.get('/calendar/status?roomCode=' + '{{$room_code}}' + '&time=' + moment().format(), function(current_event){
          if (current_event){
            var start = moment(current_event.event_start).format('hh:mm:ss');
            var end = moment(current_event.event_end).format('hh:mm:ss');

            $('#now').html(current_event.event_title);
            $('#status').html(start + ' - ' + end);
            $('#eventtitle').css('background', '#b71c1c');
            $('#eventbox').removeClass('free-room').addClass('used-room');
          }
          else {
            $('#now').html('-');
            $('#status').html('Ruangan kosong');
            $('#eventtitle').css('background', '#ffb300');
            $('#eventbox').removeClass('used-room').addClass('free-room');
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
    }

    update_board();
    setInterval(update_board, 60000);
  </script>
@endsection
