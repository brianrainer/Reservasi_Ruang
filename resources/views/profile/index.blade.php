@extends('layouts.master')

@section('title', 'Profil')

@section('content')
  <h1>Profil</h1>
  <table class="centered responsive-table">
    <thead>
      <th>Nama</th>
      <th>Email</th>
      <th>Phone No.</th>
      <th>Action</th>
    </thead>
    <tbody>
      <tr>
        <td>{{$user->user_name}}</td>
        <td>{{$user->email}}</td>
        <td>
          @if ($user->user_phone_number)
            {{$user->user_phone_number}}
          @else
            Not Set
          @endif
        </td>
        <td>
          <a href="{{url('profile')}}" class="btn btn-primary">Edit</a>
        </td>
      </tr>
    </tbody>
  </table>
@endsection