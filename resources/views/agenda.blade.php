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
        <div class="row" id="upperdiv">
          <div class="col s12 m12 l12">
            <h4 class="center-align" style="color: white"><strong>{{$room_code}}</strong></h4>
          </div>
        </div>
        <div id="bottomdiv" class="row">
          <div class="col s12 m12 l3" style="border-right-color: #1565c0">
            <h5><strong id="time"></strong></h5>
            <h5 id="day"></h5>
          </div>
          <div id="eventdiv" class="col s12 m12 l9">
            <h4 class="marquee"><strong id="now"></strong></h4>
            <h5 id="status"></h5>
          </div>
        </div>
      </div>
    @endisset
    </div>
    <div class="row center-align" style="padding:10px;">
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

    var flag = null;
    var posters;

    function updateTime(){
      var day = moment().format('dddd, DD-MM-YYYY');
      var time = moment().format('HH:mm');

      $('#day').html(day);
      $('#time').html(time);
    }

    function updateBoard(){
      @isset($room_code)
        $.get('/calendar/status?roomCode=' + '{{$room_code}}' + '&time=' + moment().format(), function(api_data){
          if (api_data && flag !== api_data.event.event_title){
            var event = api_data.event;
            var start = moment(event.event_start).format('HH:mm');
            var end = moment(event.event_end).format('HH:mm');
            flag = event.event_title;

            $('#qr').remove();
            $('.marquee').marquee('destroy');
            $('#now').html(event.event_title);
            $('#status').html(start + ' - ' + end);
            $('#upperdiv').css('background', '#b71c1c');
            $('#eventbox').removeClass('free-room').addClass('used-room');
            $('#eventdiv').removeClass('m12 l9').addClass('m9 l7');
            $('#bottomdiv').append("<div id='qr' class='col s12 m3 l2'>" + api_data.qr + "<br>Scan untuk Absen</div>");
            $('.marquee').marquee({
              duration: 5000,
              delayBeforeStart: 0,
              direction: 'left',
            })
          } else if (!api_data) {
            flag = null;

            $('.marquee').marquee('destroy');
            $('#qr').remove();
            $('#now').html('Ruangan Kosong');
            $('#status').html('');
            $('#upperdiv').css('background', '#1565c0');
            $('#eventbox').removeClass('used-room').addClass('free-room');
            $('#eventdiv').removeClass('m9 l7').addClass('m12 l9');
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
        allDaySlot: false,
        slotLabelFormat: 'HH:mm',
        height: 'auto',
        timeFormat: 'HH:mm',
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

      setTimeout(showCalendar, 300000);
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
