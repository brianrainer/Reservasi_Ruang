@extends('layouts.master')

@section('title', 'Staff')

@section('content')
  <h3>Staff</h3>

  @include('layouts.status')

  <a href="{{url('/staff/create')}}" class="btn waves-light waves-effect">
    <i class="material-icons right">add</i>add
  </a>
  <table class="centered responsive-table">
    <thead>
      <th>Nama</th>
      <th>Email</th>
      <th>Phone No.</th>
      <th>Action</th>
    </thead>
    <tbody>
      @foreach($users as $user)
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
          <a href="{{url('staff/'.$user->id)}}" class="btn btn-primary">Edit</a> 
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{$users->links()}}
@endsection
