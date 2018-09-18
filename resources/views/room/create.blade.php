@extends('layouts.master')

@section('title', 'ReservasiTC | Tambah Ruangan')

@section('content')
  <h1>Tambah Ruangan</h1>
  @include('layouts.status')
  @include('layouts.errors')

  <div class="row">
  
    
      <form class="col s12" method="POST" action="{{url('/room/create')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">meeting_room</i>
            <input type="text" value="{{old('room_code')}}" id="room_code" name="room_code" class="validate" required>
            <label for="room_code">Kode Ruangan</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">style</i>
            <input type="text" value="{{old('room_name')}}" id="room_name" name="room_name" class="validate" required>
            <label for="room_name">Nama Ruangan</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <select name="tech[]" multiple required>
              <option value="" disabled>Choose Technician</option>
              @foreach ($technician as $t)
                <option value='{{$t->id}}'>{{$t->user_name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row">
          <div class="file-field input-field col s12">
            <div class="btn">            
              <span>Gambar</span>
              <input type="file" name="room_imagepath" id="room_imagepath">
            </div>
            <div class="file-path-wrapper">
              <input type="text" class="file-path validate" placeholder="Upload File">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <button class="btn waves-effect waves-light right" type="submit">
              Create <i class="material-icons right">send</i>
            </button>
          </div>
        </div>        
      </form>


  </div>

@endsection

@section('js')
@endsection