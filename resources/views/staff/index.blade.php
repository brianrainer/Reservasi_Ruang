@extends('layouts.master')

@section('title', 'Staff')

@section('content')
  <div class="container" style="width:80%">
    <h3>Staff</h3>

    @include('layouts.status')

    @if (Auth::check())
      <a href="{{url('/staff/create')}}" class="btn waves-light waves-effect blue darken-4">
        <i class="material-icons right">add</i>add
      </a>
    @endif

    <table class="centered responsive-table">
      <thead>
        <th>Nama</th>
        <th>Email</th>
        <th>Phone No.</th>
        @if (Auth::check())
          <th>Action</th>
        @endif
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
          @if (Auth::check())
            <td>
              <a href="{{url('staff/'.$user->id)}}" class="btn btn-primary blue darken-4">Edit</a> 
            </td>
          @endif
        </tr>
        @endforeach
      </tbody>
    </table>
    {{$users->links()}}
  </div>  
@endsection
