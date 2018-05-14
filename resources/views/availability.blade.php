@extends('master')

@section('title')
  Room Availability
@endsection

@section('content')
  @php
    {{ 
      $hours = ['07:00', '08:00', '09:00', '10:00', '11:00', '12:00',
                '13:00', '14:00', '15:00', '16:00', '17:00', '18:00',
                '19:00', '20:00', '21:00'];
      $class = ['IF-101', 'IF-102', 'IF-103', 'IF-104', 'IF-105A',
                'IF-105B','IF-106', 'IF-108', 'AULA-207', 'RTV-205', 
                'RTV-210' ]; 
    }}
  @endphp

  <h2>Room Availability</h2>
  <h5>Available/Reserved room</h5>
  <form class="col s12">
    <div class="row">
      <div class="input-field col s12 m5">
        <i class="material-icons prefix">date_range</i>
        <input type="text" class="datepicker" id="start_date" class="validate">
        <label for="start_date">Start Date</label>
      </div>
      <div class="input-field col s12 m5">
        <i class="material-icons prefix"></i>
        <input type="text" class="datepicker" id="end_date" class="validate">
        <label for="end_date">End Date</label>
      </div>
      <div class="col s12 m2">
        <button type="submit" name="action" class="btn waves-effect waves-light right">
          View
        </button>
      </div>
    </div>
  </form>

  <div class="row">
    <div class="col s12">
      <ul class="collapsible" data-collapsible="accordion">
        @php
          {{ 
            $begin = new DateTime();
            $end = new DateTime();
            $end->modify('+3 day');
          }}
        @endphp
        @for ($i = $begin; $i <= $end; $i->modify('+1 day'))
          <li>
            <div class="collapsible-header">
              {{$i->format('d M Y')}}
            </div>
            <div class="collapsible-body">
              <table class="centered striped responsive-table">
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
                          <i class="material-icons prefix">check</i>
                        </td>
                      @endforeach
                    </tr>
                  @endforeach
                </tbody>
              </table>  
            </div>
          </li>
        @endfor
      </ul>
    </div>
  </div>
@endsection

@section('jsScripts')
  <script type="text/javascript">
    $('.datepicker').pickadate({
      selectYears: 4,
      selectMonths: true, 
      close: 'OK',
      closeOnSelect: false,
      onStart: function(){
        var date = new Date();
        this.set('select', [date.getFullYear(), date.getMonth(), date.getDate()]);
      }
    });

    $(document).ready(function(){
      $('.collapsible').collapsible();
    });
  </script>
@endsection