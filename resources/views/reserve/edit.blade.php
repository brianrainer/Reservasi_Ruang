@extends('layouts.master')

@section('title')
  Reservasi TC | Edit Detail Reservasi
@endsection

@section('content')
<div class="container" style="width:80%">  
  <h1>Form Edit Reservasi</h1>
  @include('layouts.status')
  @include('layouts.errors')

  <form action="{{url('reserve/edit')}}" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="booking_id" value="{{$booking->id}}">

    @component('reserve.form-user', ['agencies' => $agencies])
      @slot('full_name', $booking->name)
      @slot('nrp_nip', $booking->nrp_nip)
      @slot('phone_number', $booking->phone_number)
      @slot('email', $booking->email)
      @slot('pic_title_1', $booking->pic_title_1)
      @slot('pic_name_1', $booking->pic_name_1)
      @slot('pic_title_2', $booking->pic_title_2)
      @slot('pic_name_2', $booking->pic_name_2)
    @endcomponent

    @component('reserve.form-event', ['categories' => $categories])
      @slot('title', $booking->event_title)
      @slot('event_description', $booking->event_description)
    @endcomponent
  </form>
</div>
@endsection

@section('js')
  @include('reserve.form-js')
@endsection