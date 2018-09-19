@extends('layouts.master')

@section('title', 'Edit Detail Ruangan')

@section('content')
  <h1>Edit Detail Ruangan</h1>
  @include('layouts.status')
  @include('layouts.errors')

  <div class="row">
    @if (empty($room))
      <div class="card-panel red">
        Data Ruangan belum ada
      </div>
    @elseif (!$technicians->count())
      <div class="card-panel red">
        Data Teknisi belum ada
      </div>
    @elseif(Auth::check() && Auth::users()->hasRole('manage_room'))
      <form class="col s12" method="POST" action="{{url('/room/edit/'.$room->room_id)}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">meeting_room</i>
            <input type="text" value="{{$room->room_code}}" id="room_code" name="room_code" class="validate" required>
            <label for="room_code">Kode Ruangan</label>
            <span class="helper-text">
              Kode ruangan harus unik
              <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan kode ruangan berbeda untuk setiap ruangan">help</i>
            </span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">style</i>
            <input type="text" value="{{$room->room_name}}" id="room_name" name="room_name" class="validate" required>
            <label for="room_name">Nama Ruangan</label>
            <span class="helper-text">
              Deskripsi / jenis ruangan
              <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Deskripsikan secara singkat dan jelas">help</i>
            </span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <select name="tech[]" class="validate" multiple>
              <option value="" disabled>Choose Technician</option>
              @foreach ($technicians as $t)
                <option value='{{$t->id}}'>{{$t->name}}</option>
              @endforeach
            </select>
            <label for="tech">Teknisi</label>
            <span class="helper-text">
              Apabila opsi ini dikosongi data teknisi ruangan tidak akan diubah
              <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Isi opsi ini hanya jika ingin mengubah data teknisi ruangan">help</i>
            </span>
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
            <span class="helper-text">
              Apabila opsi ini dikosongi data gambar tidak akan diubah
              <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Isi opsi ini hanya jika ingin mengubah data gambar ruangan">help</i>
            </span>
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

@section('js')
  @include('room.form-js')
@endsection