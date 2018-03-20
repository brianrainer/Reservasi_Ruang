@extends('master')

@section('title')
  Reservation Form
@endsection

@section('content')
  @php
    {{
      $class = ['IF-101', 'IF-102', 'IF-103','AULA-207', 'RTV-210',  'LP-305' ]; 
      $routine = ['Daily', 'Weekly', 'Biweekly', 'Monthly']; 
      $category = ['Lecture/Course', 'Workshop', 'Organization', 'Meeting', 'Other']; 
    }}
  @endphp

  <h2>Reservation Form</h2>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
    <div class="row">
      <form class="col s12" method="POST" action="{{ route('formsubmit') }}">
        {{ csrf_field() }}
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <input type="text" value="{{ old('name') }}" id="name" name="name" placeholder="Full Name" class="validate">
            <label for="full_name">Full Name</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m6">
            <i class="material-icons prefix">phone</i>
            <input type="text" value="{{ old('phone_number') }}" name="phone_number" placeholder="e.g., 081234345777" class="validate">
            <label for="phone_number">Phone Number</label>
          </div>
          <div class="input-field col s12 m6">
            <i class="material-icons prefix">email</i>
            <input type="email" value="{{ old('email') }}" name="email" placeholder="e.g., andy{{'@'}}gmail.com" class="validate">
            <label for="email">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">event</i>
            <input type="text" value="{{ old('title') }}" name="title" placeholder="e.g., Substitute Class for Course OOP B" class="validate">
            <label for="event_title">Event Title</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">room</i>            
            <select name='room' value="{{ old('room') }}">
              <option value="" disabled selected>Choose Room</option>
              @foreach ($class as $c)
                <option value='{{$c}}'> {{$c}} </option>
              @endforeach
            </select>
            <label>Room</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">group</i>
            <input type="text" value="{{ old('agencies') }}" name="agencies" placeholder="e.g., HMTC, or Lecturer" class="validate">
            <label for="agencies">Agencies</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">date_range</i>
            <input type="text" value="{{ old('start_data') }}" class="datepicker" id="start_date" name="start_date" class="validate">
            <label for="start_date">Start Date</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m6">
            <i class="material-icons prefix">access_time</i>
            <input type="text" value="{{ old('start_time') }}" class="timepicker" id="start_time" name="start_time" class="validate">
            <label for="start_time">Start Time</label>
          </div>
          <div class="input-field col s12 m6">
            <i class="material-icons prefix"></i>
            <input type="number" value="{{ old('duration') }}" id="duration" name="duration" class="validate">
            <label for="duration">Duration (minutes)</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m6">
            <i class="material-icons prefix">timeline</i>
            <select name='routine'>
              @foreach ($routine as $r)
                <option value="{{$r}}">{{$r}}</option>
              @endforeach
            </select>
            <label>Event Routine</label>
          </div>
          <div class="input-field col s12 m6">
            <i class="material-icons prefix"></i>
            <input type="number" value="{{ old('howmanytimes') }}" id="howmanytimes" name="howmanytimes" class="validate">
            <label for="howmanytimes">How many times</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">view_quilt</i>
            <select name='category' value="{{ old('category') }}">
              @foreach ($category as $c)
                <option value="{{$c}}">{{$c}}</option>
              @endforeach
            </select>
            <label>Event Category</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">event_note</i>
            <textarea id='event_desc' value="{{ old('event_desc') }}" name='event_desc' class='materialize-textarea' data-length='240' placeholder="Brief description about the event"></textarea>
            <label for="event_description">Event Description</label>
          </div>
        </div>
        <div class="col s12">
          <button class="btn waves-effect waves-light right" type="submit" name="action">
            Submit <i class="material-icons right">send</i>
          </button>
        </div>
      </form>
    </div>
@endsection

@section('jscripts')
  <script type="text/javascript">
    $('#howmanytimes').val(1);
    $('#event_description').trigger('autoresize');

    $('.datepicker').pickadate({
      selectYears: 2,
      selectMonths: true, 
      close: 'OK',
      today: '',
      closeOnSelect: false,
      min: true,
      disable: [
        {from:true, to:2}
      ]
    });

    $('.timepicker').pickatime({
      default: 'now',
      twelvehour: false,
      donetext: 'OK',
      autoclose: false
    });

    $(document).ready(function() {
      $('textarea#event_description').characterCounter();
      $('select').material_select();
    });
  </script>
@endsection