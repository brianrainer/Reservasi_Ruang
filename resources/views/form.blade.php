@extends('master')

@section('title')
  Reservation Form
@endsection

@section('content')
  <h2>Reservation Form</h2>
    <div class="row">
      <form class="col s12">
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <input type="text" id="full_name" placeholder="Full Name" class="validate">
            <label for="full_name">Full Name</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m6">
            <i class="material-icons prefix">phone</i>
            <input type="text" name="phone_number" placeholder="e.g. 08123434777" class="validate">
            <label for="phone_number">Phone Number</label>
          </div>
          <div class="input-field col s12 m6">
            <i class="material-icons prefix">email</i>
            <input type="email" name="email" placeholder="e.g. andy{{'@'}}gmail.com" class="validate">
            <label for="email">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">event</i>
            <input type="text" name="event_title" placeholder="e.g. Kelas Pengganti PAA F" class="validate">
            <label for="event_title">Title</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m6">
            <i class="material-icons prefix">date_range</i>
            <input type="text" class="datepicker" id="start_date" class="validate">
            <label for="start_date">Start Date</label>
          </div>
          <div class="input-field col s12 m6">
            <i class="material-icons prefix"></i>
            <input type="text" class="datepicker" id="end_date" class="validate">
            <label for="end_date">End Date</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m6">
            <i class="material-icons prefix">access_time</i>
            <input type="text" class="timepicker" id="start_time" class="validate">
            <label for="start_time">Start Time</label>
          </div>
          <div class="input-field col s12 m6">
            <i class="material-icons prefix"></i>
            <input type="text" class="timepicker" id="end_time" class="validate">
            <label for="end_time">End Time</label>
          </div>
        </div>
        <div class="row">
          <div class="col s12 m4 l3">
            <p>
              Event Category
            </p>
            <p>
              <input name="event_cat" type="radio" id="optkuliah" class="with-gap" />
              <label for="optkuliah">Kuliah</label>
            </p>
            <p>
              <input name="event_cat" type="radio" id="optworkshop" class="with-gap"/>
              <label for="optworkshop">Pelatihan</label>
            </p>
            <p>
              <input name="event_cat" type="radio" id="opthimpunan" class="with-gap"/>
              <label for="opthimpunan">Himpunan</label>
            </p>
            <p>
              <input name="event_cat" type="radio" id="optother" class="with-gap"/>
              <label for="optother">Lain-lain</label>
            </p>
          </div>
          <div class="input-field col s12 m8 l9">
            <i class="material-icons prefix">event_note</i>
            <textarea id='event_description' class='materialize-textarea' data-length='240' placeholder='Deskripsi singkat acara dan penanggung jawab acara'></textarea>
            <label for="event_description">Description</label>
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
    // $('#event_description').val('Deskripsi singkat:\nPenanggung jawab event:');
    $('#event_description').trigger('autoresize');

    // var $startdateinput = $('#start_date').pickadate()
    // var $startdatepicker = $startdateinput.pickadate('picker')
    // var $enddateinput = $('#end_date').pickadate()
    // var $enddatepicker = $enddateinput.pickadate('picker')

    $('.datepicker').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 2, // Creates a dropdown of 15 years to control year,
      today: 'Today',
      clear: 'Clear',
      close: 'OK',
      closeOnSelect: false // Close upon selecting a date,
      // onSet: function(context){
      //   console.log('Just set some stuff:', context)
      // }
    });

    $('.timepicker').pickatime({
      default: 'now', // Set default time: 'now', '1:30AM', '16:30'
      fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
      twelvehour: false, // Use AM/PM or 24-hour format
      donetext: 'OK', // text for done-button
      cleartext: 'Clear', // text for clear-button
      canceltext: 'Cancel', // Text for cancel-button
      autoclose: false, // automatic close timepicker
      ampmclickable: true, // make AM PM clickable
      aftershow: function(){} //Function for after opening timepicker
    });
    
    $(document).ready(function() {
      $('textarea#event_description').characterCounter();
    });
  </script>
@endsection