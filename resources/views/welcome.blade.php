@extends('layouts.master')

@section('title', 'ReservasiTC | Welcome')

@section('css')
  <style>
    .parallex-img {
      max-width: 70%;
      opacity: 1; 
    } 
  </style>
@endsection

@section('content')
  <div class="parallax-container">
    <div class="parallax">
      <img class="parallex-img" src="{{url('/images/informatika_front.jpg')}}">
    </div>
  </div>
  <div class="container" style="width:80%">
    <div class="row" style="padding:30px;">
      <ul class="collapsible">
        <li>
          <div class="collapsible-header"><i class="material-icons">details</i><strong>Langkah-langkah peminjamanan</strong></div>
          <div class="collapsible-body">
            <strong>Reservasi</strong>
            <ol>
              <li>Pastikan tanggal peminjaman tidak bertabrakan dengan acara lain.</li>
              <li>Peminjam mengajukan permohonanan peminjaman ruangan kepada Kepala Jurusan Departemen Informatika ITS.</li>
            </ol>
            <strong>Persetujuan</strong>
            <ol>
              <li>Setelah semua proses peminjaman ruangan disetujui, peminjam menghubungi penanggung jawab ruangan untuk mendapatkan kunci.</li>
              <li>Informasi tiap ruang dapat dilihat di laman <a href="/room">ruangan</a>.</li>
            </ol>
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">details</i><strong>Diagram alur peminjaman</strong></div>
          <div class="collapsible-body center">
            <img src="{{url('/images/diagramalur.png')}}" style="max-width:100%"></img>
          </div>
        </li>
      </ul>
      <ul class="collapsible">
        <li>
          <div class="collapsible-header"><i class="material-icons">details</i><strong>Tata tertib penggunaan ruang</strong></div>
          <div class="collapsible-body">
            <ol>
              <li>Penggunaan/pemakaian ruangan harus mendapat persetujuan dari ketua jurusan Teknik Informatika ITS.</li>
              <li>Pengajuan peminjaman maksimal 2 minggu sebelum pelaksanaan kegiatan.</li>
              <li>Penggunaan ruang hanya diperbolehkan pada rentang waktu jam kerja (08:00 -18:00) di hari kerja, dan maksimal pukul 16:00 untuk hari Sabtu dan Minggu.</li>
              <li>Pengguna atau Peminjam hanya dikhususkan untuk civitas akademika Jurusan Teknik Informatika ITS.</li>
              <li>Pengguna/peminjam ruang wajib melakukan pemeriksaan kondisi barang yang akan digunakan sebelum maupun sesudah digunakan untuk memastikan keadaan kondisi barang dalam keadaan baik.</li>
              <li>Tidak dibenarkan meninggalkan meninggalkan ruang dalam keadaan kosong dan tidak terkunci.</li>
              <li>
                Jika terjadi kerusakan inventaris ruang  karena kelalaian/kecerobohan pemakaian maka yang bersangkutan diberi sanksi untuk:
                <ol type="a">
                  <li>Memperbaiki alat tersebut apabila kerusakan tersebut dapat diperbaiki.</li>
                  <li>Mengganti dengan alat yang baru apabila kerusakan tersebut tidak bisa diperbaiki.</li>
                </ol>
              </li>   
            </ol>
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">details</i><strong>Tata tertib penggunaan aula</strong></div>
          <div class="collapsible-body">
            Selain aturan-aturan diatas terdapat beberapa aturan peminjaman aula:
            <ol>
              <li>Peserta kegiatan minimal 75 orang. Jika pada waktu pelaksanaan kegiatan peserta yang hadir kurang dari 75 orang, maka kegiatan tersebut harus bersedia dipindahkan di ruangan lain.</li>
              <li>Dilarang masuk ke dalam ruang operator.</li>
              <li>Dilarang melipat/memindahkan kursi tanpa seijin petugas aula.</li>
              <li>Dilarang membawa kunci aula.</li>
              <li>Setelah acara/kegiatan selesai, peminjam/pemakai segera menghubungi petugas aula.</li>
              <li>Dilarang membuang sampah/meninggalkan bekas makan dan minum didalam ruang aula.</li>
            </ol>  
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">details</i><strong>Fasilitas Aula</strong></div>
          <div class="collapsible-body">
            <ol>
              <li>Kapasitas kursi 200 orang</li>
            </ol>  
          </div>
        </li>
      </ul>
   </div>
  </div>
@endsection

@section('js')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#calendar').fullCalendar({
        eventSources : [
          {
            url: 'calendar/accepted',
            color: 'green',
            textColor: 'white',
            borderColor: 'black',
            cache: true
          },
        ],
        timeFormat: 'H:mm'
      })
    });

    $(document).ready(function(){
      $('.collapsible').collapsible()
    });

    $(document).ready(function(){
      $('.parallax').parallax();
    });
  </script>
@endsection
