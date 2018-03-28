@extends('master')

@section('title')
  Calendar
@endsection

@section('content')
  <div class="row" style="padding:30px;">
    <div id="calendar"></div>
  </div>
@endsection

@section('jsScripts')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#calendar').fullCalendar({

      })
    });
  </script>
@endsection