@extends('layouts.master')

@section('title','ReservasiTC | Multiple Once')

@section('content')
  <h1>Reservasi Eventual Banyak Ruangan</h1>
  @include('layouts.status')
  @include('layouts.errors')

  @if ($rooms->count() && $agencies->count() && $routines->count() && $categories->count())
    <div class="row">
      <form class="col s12" method="POST" action="{{url('/reserve/multionce')}}">
        {{csrf_field()}}
        @include('reserve.form-user')
        @include('reserve.form-mult-room')
        @include('reserve.form-time')
        @include('reserve.form-one-routine')
        @include('reserve.form-event')
      </form>
    </div>
  @else
    @include('reserve.else-div')
  @endif
@endsection

@section('js')
  @include('reserve.form-js')
@endsection