@extends('layouts.master')

@section('title', 'Create Staff')

@section('content')
  <h3>Create Staff</h3>

  @include('layouts.errors')

  <div class="row">
    <form class="col s12" method="POST" action="{{url('/staff/create')}}">
      {{csrf_field()}}
      <div class="row">
        <div class="input-field col s12">
          <input type="text" value="{{ old('user_name') }}" id="user_name" name="user_name" class="validate" required>
          <label for="user_name">Nama Lengkap</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="text" value="{{ old('nrp_nip') }}" id="nrp_nip" name="nrp_nip">
          <label for="nrp_nip">NRP/NIP</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="text" value="{{ old('email') }}" id="email" name="email" class="validate" required>
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="text" value="{{ old('user_phone_number') }}" id="user_phone_number" name="user_phone_number" class="validate">
          <label for="user_phone_number">Nomor Telpon</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="password" id="password" name="password" class="validate" required>
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="password" id="password_confirmation" name="password_confirmation" class="validate" required>
          <label for="password_confirmation">Confirm Password</label>
        </div>
      </div>

      <div class="row">
        <div class="col s12">
          <button class="btn waves-effect waves-light left" type="submit" name="action">
           Create <i class="material-icons right">save</i>
          </button>
        </div>
      </div>
   </form>
  </div>
@endsection
