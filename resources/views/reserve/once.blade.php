@extends('layouts.master')

@section('title','Reservasi - Sekali')

@section('content')
  <h1>Reservasi - Sekali</h1>
  @if ($rooms->count())
    <div class="row">
      <form class="col s12" method="POST" action="{{url('/form/once')}}">
        {{csrf_field()}}
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <input type="text" value="{{ old('full_name') }}" id="full_name" name="full_name" maxlength="100" class="validate" required>
            <label for="full_name">Nama Lengkap</label>
            <span class="helper-text" data-error="Nama Lengkap harus berupa string maksimal 100 karakter">
              Masukkan Nama Lengkap Anda
            </span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m6">
            <i class="material-icons prefix">phone</i>
            <input type="text" value="{{ old('phone_number') }}" name="phone_number" class="validate" pattern="[0-9]{8,12}" required>
            <label for="phone_number">Nomor Telepon</label>
            <span class="helper-text" data-error="Nomor Telepon harus berupa angka 8-12 digit">
              Masukkan Nomor Telepon Anda
            </span>
          </div>
          <div class="input-field col s12 m6">
            <i class="material-icons prefix">email</i>
            <input type="email" value="{{ old('email') }}" name="email" class="validate" required>
            <label for="email">Email</label>
            <span class="helper-text" data-error="Email harus menggunakan format email yang benar">
              Masukkan Email Anda
            </span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix"></i>
            <input type="text" value="{{ old('name') }}" id="nrp_nip" name="nrp_nip" class="validate" pattern="[0-9]{10,20}">
            <label for="nrp_nip">NRP / NIP</label>
            <span class="helper-text">
              Masukkan NRP bila Anda Mahasiswa, atau NIP bila Anda Dosen
            </span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">group</i>
            <select name="agency" value="{{old('agency')}}" required>
              <option value="" disabled>Choose Agency</option>
              @foreach ($agencies as $agency)
                <option value="{{$agency->id}}">{{$agency->agency_name}}</option>
              @endforeach
            </select>
            <label for="agency">Organisasi yang Diwakilkan</label>
            <span class="helper-text">Pilih Organisasi yang Anda Wakilkan</span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix" required>room</i>            
            <select name='room' value="{{ old('room') }}" required>
              <option value="" disabled>Choose Room</option>
              @foreach ($rooms as $room)
                <option value='{{$room->id}}'> {{$room->room_name}} </option>
              @endforeach
            </select>
            <label for="room">Ruangan</label>
            <span class="helper-text">Pilih Ruangan yang akan Anda Gunakan</span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">date_range</i>
            <input type="text" value="{{ old('start_data') }}" class="datepicker" id="start_date" name="start_date" class="validate" required>
            <label for="start_date">Tanggal</label>
            <span class="helper-text">Pilih Tanggal Acara Anda</span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m6">
            <i class="material-icons prefix">access_time</i>
            <input type="text" value="{{ old('start_time') }}" class="timepicker" id="start_time" name="start_time" class="validate" required>
            <label for="start_time">Waktu Mulai</label>
            <span class="helper-text">Pilih Waktu Mulai Acara</span>
          </div>
          <div class="input-field col s12 m6">
            <i class="material-icons prefix"></i>
            <input type="text" value="{{ old('end_time') }}" class="timepicker" id="end_time" name="end_time" class="validate" required>
            <label for="end_time">Waktu Selesai</label>
            <span class="helper-text">Pilih Waktu Selesai Acara</span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">event</i>
            <input type="text" value="{{ old('title') }}" name="title" class="validate" required>
            <label for="event_title">Nama Acara</label>
            <span class="helper-text">Masukkan Nama Acara Anda</span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">view_quilt</i>
            <select name='category' value="{{ old('category') }}" required>
              @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->category_name}}</option>
              @endforeach
            </select>
            <label for="category">Kategori Acara</label>
            <span class="helper-text">Pilih Kategori Acara Anda</span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">event_note</i>
            <textarea id='event_desc' value="{{ old('event_desc') }}" name='event_desc' class='materialize-textarea' data-length='240' placeholder="Brief description about the event" required></textarea>
            <label for="event_description">Deskripsi Acara</label>
            <span class="helper-text">Berikan Deskripsi Singkat untuk Acara Anda</span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <p>
              <label>
                <input type="checkbox" name="agree" class="filled-in" required>
                <span>
                  Saya sudah membaca dan setuju dengan 
                  <a href="{{url('terms')}}">Syarat dan Ketentuan Reservasi</a> 
                </span>
              </label>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <button class="btn waves-effect waves-light right" type="submit" name="action">
              Submit <i class="material-icons right">send</i>
            </button>
          </div>
        </div>
      </form>
    </div>
  @else

  @endif
@endsection

@section('js')
  <script type="text/javascript">
    $(document).ready(function(){
      $('select').formSelect();
      $('.datepicker').datepicker();
      $('.timepicker').timepicker({
        twelveHour: false,
      });
    });
  </script>
@endsection

{{-- 
        <div class="row">
          <div class="input-field col s12 m6">
            <i class="material-icons prefix">timeline</i>
            <select name='routine' required>
              @foreach ($routines as $routine)
                <option value="{{$routine->id}}">{{$routine->routine_name}}</option>
              @endforeach
            </select>
            <label for="routine" data-error="Please choose a routine">Event Routine</label>
          </div>
          <div class="input-field col s12 m6">
            <i class="material-icons prefix"></i>
            <input type="number" value="{{ old('howmanytimes') }}" id="howmanytimes" name="howmanytimes" class="validate" required min="1" max="16">
            <label for="howmanytimes" data-error="Minimum repetition is 1 and maximum repetition is 16">How many times</label>
          </div>
        </div>
 --}}
