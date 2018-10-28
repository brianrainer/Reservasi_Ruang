@extends('layouts.master')

@section('title', 'Staff')

@section('content')
  <div class="container" style="width:80%">
    <h3>Staff</h3>

    @include('layouts.status')

    <a href="{{url('/staff/create')}}" class="btn waves-light waves-effect blue darken-4">
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
            <a class="waves-effect waves-light btn modal-trigger red" href="#{{$user->id}}">Hapus</a>
            <a href="{{url('staff/'.$user->id)}}" class="btn btn-primary blue darken-4">Edit</a> 
            <div id="{{$user->id}}" class="modal left-align">
              <div class="modal-header">
                <a class="btn btn-flat right modal-close">&times;</a>
              </div>
              <div class="modal-content">
                <h4>
                  Delete Staff
                </h4>
                <p>Apakah anda yakin akan menghapus <strong>{{$user->user_name}}</strong> dari staff?</p>
              </div>
              <div class="modal-footer">
                <form method="POST" action="{{url('/staff/'.$user->id)}}">
                  {{csrf_field()}}
                  <input type="hidden" name="_method" value="DELETE">
                  <a class="btn waves-effect waves-light grey modal-close">
                    Kembali
                  </a>
                  <button class="btn waves-effect waves-light red" type="submit">
                    Hapus
                  </button>
                </form>
              </div>
            </div> 
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{$users->render()}}
  </div>  
@endsection

@section('js')
  <script type="text/javascript">
    $(document).ready(function(){
      $('.modal').modal();
    });
  </script>
@endsection
