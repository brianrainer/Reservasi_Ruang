@extends('layouts.master')

@section('title', 'ReserveTC | Edit Detail Status')

@section('content')
  <h1>Edit Detail Reservasi</h1>
  @include('layouts.status')
  @include('layouts.errors')

  {{-- @if ($detail && Auth::check()) --}}
    <div class="row">
      <form class="col s12" method="POST" action="{{url('/reserve/status/edit/'.$detail->id)}}">
        {{csrf_field()}}
        <div class="row">
          <div class="card horizontal yellow">
            <div class="card-content">
              <div class="col s12">
                Data Detail Reservasi Sebelumnya:
              </div>
              <div class="col s12">
                Ruangan: {{$detail->room_code}} ({{$detail->room_name}})
              </div>
              <div class="col s12">
              Waktu: {{$detail->event_start}} to {{$detail->event_end}}
              </div>
            </div>
          </div>
        </div>

        @include('reserve.form-one-room')
        @include('reserve.form-time')

        <div class="row">
          <div class="col s12">
            <button class="btn waves-effect waves-light right" type="submit" name="action">
              Edit <i class="material-icons right">send</i>
            </button>
          </div>
        </div>
      </form>      
    </div>
  {{-- @endif --}}
@endsection

@section('js')
  @include('reserve.form-js')
@endsection