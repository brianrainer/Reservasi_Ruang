@extends('layouts.master')

@section('title', 'Ruangan')

@section('content')
  <div class="container" style="width:80%">
    <h1>Ruangan</h1>
    <div>
      @include('layouts.status')
      @include('layouts.errors')

      @if (Auth::check())
        <div class="row">
          <a href="{{url('/room/create')}}" class="btn btn-primary waves-effect waves-light blue darken-4">Tambah Ruangan</a>
        </div>
      @endif
      @if ($rooms->count())
        <table class="responsive-table centered">
          <thead>
            <tr>
              <th>Kode</th>
              <th>Nama Ruangan</th>
              <th>Jadwal</th>
              <th>Detail Ruangan</th>
              @if (Auth::check())
                <th>Aksi Lainnya</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach ($rooms as $room)
              <tr>
                <td>{{$room->room_code}}</td>
                <td>{{$room->room_name}}</td>
                <td>
                  <a class="btn waves-effect waves-light blue darken-4" href="{{url('/agenda/'.$room->room_code)}}">Agenda</a>
                </td>
                <td>
                  <a class="btn waves-effect waves-light blue darken-4" href="{{url('/room/detail/'.$room->room_code)}}">Detail</a>
                </td>
                @if (Auth::check())
                  <td>
                    <div class="row">
                      <div class="col s12">
                        <a class="btn waves-light waves-effect blue darken-4 right" style="margin-left:0.3rem;">Edit</a>
                        <button class="btn waves-effect waves-light red modal-trigger" data-target="delete_room" onclick="fill_modal('delete_room', '{{$room->id}}')">Hapus</button>
                      </div>
                    </div>
                  </td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
        {{$rooms->render()}}
      @else
        <div class="card-panel red">
          Data Ruangan Belum Ada
        </div>
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