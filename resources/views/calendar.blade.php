@extends('layouts.master')

@section('title', 'ReservasiTC | Kalender')

@section('content')
  
  <div class="container" style="width:80%">
    <div class="row" style="padding-top:30px;padding-left:30px">
      <div class="input-field col s4">
        <select id="room_select" onChange="valueChanges(this)">
          <option value="" disabled selected>Choose your option</option>
          @foreach ($rooms as $room)
            <option value="{{$room->room_code}}">{{$room->room_code}}</option>
          @endforeach
        </select>
        <label>Pilih Ruang</label>
      </div>
    </div>
    <div class="row" style="padding:30px;">
      <div id="calendar"></div>
    </div>
  </div>
@endsection

@section('js')
  <script type="text/javascript">
    var event_url = '';
    var eventSource = {
      url: '',
      color: '#1565c0',
      textColor: 'white',
      borderColor: 'black',
      cache: true
    }

    function valueChanges(select){
      event_url = 'calendar/accepted/' + select.value;
      eventSource.url = event_url;

      $('#calendar').fullCalendar('removeEventSources');
      $('#calendar').fullCalendar('addEventSource', eventSource);
    }

    $(document).ready(function(){
      $('select').formSelect();
      $('#calendar').fullCalendar({
        eventSources : [],
        timeFormat: 'H:mm',
        eventLimit: true,
      })

      event_url = 'calendar/accepted/' + $('select').val();
      eventSource.url = event_url;
      $('#calendar').fullCalendar('addEventSource', eventSource);
    });
  </script>
@endsection
