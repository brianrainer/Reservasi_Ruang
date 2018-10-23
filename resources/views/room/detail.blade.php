@extends('layouts.master')

@section('title', 'Detail Ruangan')

@section('content')
  <div class="container" style="width:80%">
  <h1>
    Detail Ruangan
    @if ($room->room_code)
      {{$room->room_code}}
    @endif
  </h1>
  @include('layouts.status')
  @include('layouts.errors')

  <div class="row">
    @if($room)
      @component('status.detail_div')
        @slot('title')
          Kode Ruangan
        @endslot
        {{$room->room_code}}
      @endcomponent

      @component('status.detail_div')
        @slot('title')
          Nama Ruangan
        @endslot
        {{$room->room_name}}
      @endcomponent

      @component('status.detail_div')
        @slot('title')
          Teknisi
        @endslot
        @foreach ($technicians as $t)
          {{ $t->name }} {{ $t->phone}} <br>
        @endforeach
      @endcomponent

      @component('status.detail_div')
        @slot('title')
          Gambar Ruangan
        @endslot
        @if ($room->room_imagepath)
          <div class="card col s6">
            <div class="card-image">
              <img src="{{asset($room->room_imagepath)}}">
            </div>
          </div>
        @else
          Gambar belum ada
        @endif
      @endcomponent

      @component('status.detail_div')
        @slot('title')
          Cek Status Ruangan
        @endslot
        <a href="{{url('/agenda/'.$room->room_code)}}" class="btn waves-effect waves-light blue darken-4">Agenda</a>
      @endcomponent
      
      @if(Auth::check())
        @component('status.detail_div')
          @slot('title')
            Aksi Lainnya
          @endslot
          <div>
            <button class="btn waves-effect waves-light red modal-trigger" data-target="delete_room" onclick="fill_modal('delete_room', '{{$room->room_id}}')">Hapus</button>
            <a class="btn waves-light waves-effect blue darken-4" style="margin-left:0.3rem;" href="{{url('/room/edit/'.$room->room_id)}}">Edit</a>
          </div>
        @endcomponent
      @endif
    @endif
  </div>
  </div>

  <div class="modal" id="delete_room">
    <div class="modal-header">
      <a 
      class="btn btn-flat right modal-close">&times;</a>
    </div>
    <div class="modal-content">
      <h4>Konfirmasi Penghapusan Ruangan</h4>
      <p>Apakah anda yakin ingin menghapus ruangan ini? <strong>SEGALA DATA TEKNISI DAN DETAIL RESERVASI YANG BERHUBUNGAN DENGAN RUANGAN INI AKAN DIHAPUS</strong></p>
      <form id="form_delete_room" method="POST" action="{{url('/room/delete')}}">
        {{csrf_field()}}
        <input type="hidden" name="room_id" value="">
      </form>
    </div>
    <div class="modal-footer">
      <a class="btn waves-effect waves-light grey modal-close">Kembali</a>
      <button class="btn waves-light waves-effect red" onclick="submit_form('form_delete_room')">Hapus</button>
    </div>
  </div>
@endsection

@section('js')
  <script type="text/javascript">
    function fill_modal(modal_id, room_id){
      $("#"+modal_id+" input[name='room_id']").val(room_id);
    }

    function submit_form(form_id){
      document.getElementById(form_id).submit();
    }

    $(document).ready(function(){
      $('.modal').modal();
    })
  </script>
@endsection