@extends('layouts.master')

@section('title','ReservasiTC | Once')

@section('content')
  <div class="container" style="width:80%">
    <h1>Reservasi Eventual Satu Ruangan</h1>
    @include('layouts.status')
    @include('layouts.errors')

    @if ($rooms->count() && $agencies->count() && $routines->count() && $categories->count())
      <div class="row">
        <form class="col s12" method="POST" action="{{url('/reserve/once')}}">
          {{csrf_field()}}
          @include('reserve.form-user')
          @include('reserve.form-one-room')
          @include('reserve.form-time')
          @include('reserve.form-one-routine')
          @include('reserve.form-event')
        </form>
      </div>
    @else
      @include('reserve.else-div')
    @endif
  </div>
@endsection

@section('js')
  @include('reserve.form-js')
@endsection
