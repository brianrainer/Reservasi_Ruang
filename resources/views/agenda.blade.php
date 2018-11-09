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
          <div class="col s12 m5 l4" style="border-right-color: #1565c0">
            <h5><strong id="time"></strong></h4>
            <h5 id="day"></h4>
          </div>
          <div class="col s12 m7 l8">
            <h4 class="marquee"><strong id="now"></strong></h4>
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

    var flag = 1;
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
          if (current_event && flag){
            var start = moment(current_event.event_start).format('HH:mm');
            var end = moment(current_event.event_end).format('HH:mm');
            flag = 0;

            $('#now').html(current_event.event_title);
            $('#status').html(start + ' - ' + end);
            $('#eventtitle').css('background', '#b71c1c');
            $('#eventbox').removeClass('free-room').addClass('used-room');

            $('.marquee').marquee({
              duration: 5000,
              delayBeforeStart: 0,
              direction: 'left',
            })
          } else if (!current_event) {
            flag = 1;

            $('.marquee').marquee('destroy');
            $('#now').html('Ruangan Kosong');
            $('#status').html('');
            $('#eventtitle').css('background', '#1565c0');
            $('#eventbox').removeClass('used-room').addClass('free-room');
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
        slotLabelFormat: 'HH:mm',
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
      $.get('/posters?date=' + moment().format('YYYY-MM-DDTHH:mm:ss') + '&room={{$room_code}}', function(poster_data) {
        posters = poster_data;
        if (posters && posters.length > 0) {
          setInterval(showPoster, 3600000);
        }
      })
    }

    function init() {
      updateBoard();
      setCalendar();
      updateTime();
      setRefresh();
      getPoster();
    }

    $(document).ready(function(){
      init();
      
      setInterval(updateTime, 60000);
      setInterval(updateBoard, 60000);
    });

  </script>
@endsection
