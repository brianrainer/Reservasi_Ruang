@extends('layouts.master')

@section('title', 'Edit Detail Ruangan')

@section('content')
  <h1>Edit Detail Ruangan</h1>
  @include('layouts.status')
  @include('layouts.errors')

  <div class="row">
    @if($room)
      <form class="col s12" method="POST" action="{{url('/room/edit/'.$room->room_id)}}">
        {{csrf_field()}}
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">meeting_room</i>
            <input type="text" value="{{$room->room_code}}" id="room_code" name="room_code" required>
            <label for="room_code">Kode Ruangan</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">style</i>
            <input type="text" value="{{$room->room_name}}" id="room_name" name="room_name" required>
            <label for="room_name">Nama Ruangan</label>
          </div>
        </div>
        <div class="row">
          <div class="file-field input-field col s12">
            <div class="btn">            
              <span>Gambar</span>
              <input type="file" name="room_imagefile">
            </div>
            <div class="file-path-wrapper">
              <input type="text" id="room_imagepath" name="room_imagepath" class="file-path">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <button class="btn waves-effect waves-light right" type="submit">
              Edit <i class="material-icons right">send</i>
            </button>
          </div>
        </div>        
      </form>
    @endif
  </div>
@endsection