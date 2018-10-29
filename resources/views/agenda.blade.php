@extends('layouts.agenda')

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
      border-color: #1565c0;
    }
    .used-room {
      border-color: #b71c1c; 
    }
    .fc-event {
      font-size: 1.75em;
    }
    .marquee {
      overflow: hidden;
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
            <h4 class="center-align" style="color: white"><strong>{{$room_code}}</strong></h4>
          </div>
        </div>
        <div class="row">
          <div class="col s3 m3 l3">
            <h5><strong id="time"></strong></h4>
            <h5 id="day"></h4>
          </div>
          <div class="col s9 m9 l9 marquee">
            <h3><strong id="now"></strong></h3>
            <h5 id="status"></h5>
          </div>
        </div>
      </div>
    @endisset
    </div>
    <div class="row center-align" style="padding:20px;">
      <div id="poster">
        <img id="poster-image" style="max-width: 100%; max-height:100%"/>
      </div>
      <div id="calendar"></div>
    </div>
  </div>
@endsection

@section('js')
  <script type="text/javascript">
    var calendarEvent = [
      {
        url: '/calendar/accepted',
        color: '#1565c0',
        textColor: 'white',
        borderColor: 'black',
        cache: true
      }
    ];

    @isset ($room_code)    
      calendarEvent = [
        {
          url: '/calendar/accepted/' + '{{$room_code}}',
          color: '#0d47a1',
          textColor: 'white',
          borderColor: 'black',
          cache: true,
        }
      ]
    @endisset

    var posters;

    

    function updateTime(){
      var day = moment().format('dddd, DD-MM-YYYY');
      var time = moment().format('HH:mm');

      $('#day').html(day);
      $('#time').html(time);
    }

    function updateBoard(){
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
            $('#now').html('Ruangan kosong');
            $('#status').html('');
            $('#eventtitle').css('background', '#1565c0');
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
    
    function setRefresh() {
      var now = moment().unix();
      var midnight = moment().add(1, 'd').startOf('day').unix();
      var msUntilMidnight = (midnight - now) * 1000;

      setTimeout(window.location.reload.bind(window.location), msUntilMidnight);
    }

    function setCalendar() {
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

      $('#poster').hide();
    }

    function showCalendar() {
      $('#poster').fadeOut('slow', function() {
        $('#calendar').fadeIn('slow'); 
      });
    }

    function getRandomInt(len) {
      return Math.floor(Math.random() * Math.floor(len));
    }

    function showPoster() {
      $('#poster-image').attr('src', posters[getRandomInt(posters.length)]);
      $('#calendar').fadeOut('slow', function() {
        $('#poster').fadeIn('slow');
      });

      setTimeout(showCalendar, 60000);
    }

    function getPoster() {
      $.get('/posters?date=' + moment().format('YYYY-MM-DDTHH:mm:ss'), function(poster_data) {
        posters = poster_data;
        if (posters && posters.length > 0) {
          setInterval(showPoster, 3600000);
        }
      })
    }

    $(document).ready(function(){
      updateBoard();
      setCalendar();
      updateTime()
      setRefresh();
      getPoster();

      setInterval(updateTime, 60000);
      setInterval(updateBoard, 60000);
    });
  </script>
@endsection
