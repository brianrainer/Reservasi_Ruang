@extends('layouts.master')

@section('title')
  Dashboard
@endsection

@section('cssScripts')
  <style type="text/css">

  </style>
@endsection

@section('content')
  <div class="row">
    <h2>Dashboard</h2>
    <div class="col s12 m6">
      <div class="card sticky-action">
        <div class="card-image waves-effect waves-block waves-light">
          <img class="activator" src="http://materializecss.com/images/office.jpg">
        </div>
        <div class="card-content">
          <span class="card-title activator">User Management<i class="material-icons right">more_vert</i></span>
        </div>
        <div class="card-action">
          <p><a href="#">Go to User Management</a></p>
        </div>
        <div class="card-reveal">
          <span class="card-title">User Management<i class="material-icons right">close</i></span>
          <p>Add, edit, or delete users as well change their roles</p>
        </div>
      </div>
    </div>
    <div class="col s12 m6">
      <div class="card sticky-action">
        <div class="card-image waves-effect waves-block waves-light">
          <img class="activator" src="http://materializecss.com/images/office.jpg">
        </div>
        <div class="card-content">
          <span class="card-title activator">Booking Approval<i class="material-icons right">more_vert</i></span>
        </div>
        <div class="card-action">
          <p><a href="#">Go to Booking</a></p>
        </div>
        <div class="card-reveal">
          <span class="card-title">Booking Approval<i class="material-icons right">close</i></span>
          <p>Approve or reject booking requests</p>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('jsScripts')
@endsection