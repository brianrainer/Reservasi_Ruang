@extends('master')

@section('title')
  Room Management
@endsection

@section('content')
  @php
    {{ 
      $hours = ['07:00', '07:30', '08:00', '08:30', '09:30'];
      $class = ['IF-101', 'IF-102', 'IF-103','AULA-207', 'RTV-210',  'LP-305' ]; 
    }}
  @endphp

  <h2>Room Management</h2>
  <h4>Available/Reserved Room</h4>
  <h5>
    <span id="start_date_x"></span> - <span id="end_date_y"></span>
  </h5>
  <form class="col s12">
    <div class="row">
      <div class="input-field col s12 m5 l4">
        <i class="material-icons prefix">date_range</i>
        <input type="text" class="datepicker" id="start_date" class="validate">
        <label for="start_date">Start Date</label>
      </div>
      <div class="input-field col s12 m5 l4">
        <i class="material-icons prefix"></i>
        <input type="text" class="datepicker" id="end_date" class="validate">
        <label for="end_date">End Date</label>
      </div>
      <div class="col s12 m2 l4">
        <button type="submit" name="action" class="btn waves-effect waves-light right">
          Reserve <i class="material-icons right">send</i>
        </button>
      </div>
    </div>
  </form>

  <table class="centered highlight responsive-table">
    <thead>
      <tr>
        <th>Room</th>
        @foreach ($hours as $h)
          <th>{{$h}}</th>
        @endforeach
  	  </tr>
  	</thead>
    <tbody>
      @foreach ($class as $c)
        <tr>
          <td>{{$c}}</td>
          @foreach ($hours as $h)
            <td>
              Available
            </td>
          @endforeach
        </tr>
      @endforeach
    </tbody>
  </table>  
@endsection

@section('jscripts')
  <script type="text/javascript">
    $('.datepicker').pickadate({
      selectYears: 4,
      selectMonths: true, 
      close: 'OK',
      closeOnSelect: false
    });
  </script>
@endsection