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

      })
    });
  </script>
@endsection