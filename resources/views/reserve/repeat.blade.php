@extends('layouts.master')

@section('title','ReservasiTC | Repeat')

@section('content')
  <h1>Reservasi Berkala Satu Ruangan</h1>
  @include('layouts.status')
  @include('layouts.errors')

  @if ($rooms->count() && $agencies->count() && $routines->count() && $categories->count())
    <div class="row">
      <form class="col s12" method="POST" action="{{url('/reserve/repeat')}}">
        {{csrf_field()}}
        @include('reserve.form-user')
        @include('reserve.form-one-room')
        @include('reserve.form-time')
        @include('reserve.form-mult-routine')
        @include('reserve.form-event')
      </form>
    </div>
  @else
    @if (empty($rooms))
      Data Ruangan Tidak Ditemukan
    @endif
    @if (empty($routines))
      Data Jeda Berkala Kegiatan Tidak Ditemukan
    @endif
    @if (empty($agencies))
      Data Organisasi Tidak Ditemukan
    @endif
    @if (empty($categories))
      Data Kategori Kegiatan Tidak Ditemukan
    @endif
  @endif
@endsection

@section('js')
  @include('reserve.form-js')
@endsection