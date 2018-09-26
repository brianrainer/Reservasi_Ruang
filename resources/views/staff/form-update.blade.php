@extends('layouts.master')

@section('title', 'Update Staff')

@section('content')
  <div class="container" style="width:80%">
  <h3>Update Staff</h3>
  
  @include('layouts.errors')

  <div class="row">
    <form class="col s12" method="POST" action="{{url('/staff/'.$user->id)}}">
      {{csrf_field()}}
      <div class="row">
        <div class="input-field col s12">
          <input type="text" value="{{$user->user_name}}" id="user_name" name="user_name" class="validate" required>
          <label for="user_name">Nama Lengkap</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="text" value="{{$user->nrp_nip}}" id="nrp_nip" name="nrp_nip" class="validate">
          <label for="nrp_nip">NRP/NIP</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="text" value="{{$user->email}}" id="email" name="email" class="validate" required>
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="text" value="{{$user->user_phone_number}}" id="user_phone_number" name="user_phone_number" class="validate">
          <label for="user_phone_number">Nomor Telpon</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="password" id="new_password" name="new_password" class="validate">
          <label for="new_password">New Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input type="password" id="new_password_confirmation" name="new_password.confirmation" class="validate">
          <label for="new_password_confirmation">Confirm Password</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <button class="btn waves-effect waves-light left" type="submit" name="action">
           Save <i class="material-icons right">save</i>
          </button>
        </div>
      </div>
   </form>
  </div>
  </div>
@endsection
