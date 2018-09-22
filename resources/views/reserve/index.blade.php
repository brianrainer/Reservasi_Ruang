@extends('layouts.master')

@section('title','ReservasiTC | Form Reservasi')

@section('content')
  <h1>Reservasi</h1>
  <div class="row">
    <div class="col s12 m6">
      <a href="{{url('reserve/once')}}">        
        <div class="card pink">
          <div class="card-content white-text">
            <span class="card-title">Sekali Satu Ruangan</span>
            <p> Pilih menu reservasi ini bila Anda ingin mengajukan sekali peminjaman untuk satu ruangan</p>
          </div>
        </div>
      </a>
    </div>    
    <div class="col s12 m6">
      <a href="{{url('reserve/repeat')}}">
        <div class="card purple darken-1">
          <div class="card-content white-text">
            <span class="card-title">Berkala Satu Ruangan</span>
            <p> Pilih menu reservasi ini bila Anda ingin mengajukan beberapa kali peminjaman (secara berkala) untuk satu ruangan yang sama</p>
          </div>
        </div>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="divider"></div>
  </div>
  <div class="row">
    <div class="col s12 m6">
      <a href="{{url('reserve/multionce')}}">
        <div class="card yellow darken-2">
          <div class="card-content white-text">
            <span class="card-title">Sekali Banyak Ruangan</span>
            <p> Pilih menu reservasi ini bila Anda ingin mengajukan sekali peminjaman untuk beberapa ruangan sekaligus</p>
          </div>
        </div>
      </a>
    </div>    
    <div class="col s12 m6">
      <a href="{{url('reserve/multirepeat')}}">
        <div class="card orange">
          <div class="card-content white-text">
            <span class="card-title">Berkala Banyak Ruangan</span>
            <p> Pilih menu reservasi ini bila Anda ingin mengajukan beberapa kali peminjaman (secara berkala) untuk beberapa ruangan sekaligus</p>
          </div>
        </div>
      </a>
    </div>
  </div>
@endsection