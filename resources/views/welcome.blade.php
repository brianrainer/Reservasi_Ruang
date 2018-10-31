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
  <div class="parallax-container valign-wrapper">
  {{-- <div class="container center amber no-pad-bot" style="opacity:0.5">
      <h1 class="header center" style="opacity:1">Peminjaman Ruang Departemen Informatika</h1>
    </div>  --}}
    <div class="parallax">
      <img class="parallex-img" src="{{url('/images/informatika_front.jpg')}}">
    </div>
  </div>
  <div class="container" style="width:80%">
    <div class="row" style="padding:0.5rem;">
      <ul class="collapsible expendable popout">
        <li class="active">
          <div class="collapsible-header"><i class="material-icons">details</i><strong>Ketentuan Peminjaman</strong></div>
          <div class="collapsible-body">
            <ol>
              <li>Pastikan tanggal peminjaman tidak bertabrakan dengan acara lain.</li>
              <li>Peminjam mengajukan permohonanan peminjaman ruangan kepada Kepala Departemen Informatika ITS.</li>
              <li>Persetujuan reservasi oleh Kepala Departemen berkoordinasi dengan <strong>Penanggung Jawab Ruangan</strong> didasarkan atas skala prioritas dan potensi gangguan (keamanan, kebisingan) dengan kegiatan waktu yang sama.</li>
              <li>
                Setelah semua proses peminjaman ruangan disetujui, peminjam menghubungi <strong>Penanggung Jawab Ruangan</strong> untuk mendapatkan kunci:
                <strong>
                  <ul>
                    <li>Ruang Kelas - Edy Lukito</li>
                    <li>Ruang Aula - Jumali</li>
                    <li>Lab Pemrograman 1 - Junaidy Abdillah</li>
                    <li>Lab Pemrograman 2 - Dony Kusuma Hadi</li>
                  </ul>
                </strong>
              </li>
              <li>Informasi dan jadwal setiap ruangan dapat dilihat di laman <a href="/room">ruangan</a>.</li>
            </ol>
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">details</i><strong>Diagram alur peminjaman</strong></div>
          <div class="collapsible-body center">
            <img src="{{url('/images/sop_reservasi.jpg')}}" style="max-width:100%"></img>
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">details</i><strong>Tata Tertib</strong></div>
          <div class="collapsible-body">
            <ol>
              <li>Penggunaan ruangan harus mendapat persetujuan dari Kepala Departemen Informatika ITS.</li>
              <li>Pengajuan peminjaman maksimal 2 minggu sebelum pelaksanaan kegiatan.</li>
              <li>Penggunaan ruang hanya diperbolehkan pada rentang waktu jam kerja (08:00 -18:00) di hari kerja, dan maksimal pukul 16:00 untuk hari Sabtu dan Minggu.</li>
              <li>Pengguna atau Peminjam hanya dikhususkan untuk civitas akademika Jurusan Teknik Informatika ITS.</li>
              <li>Pengguna ruang wajib melakukan pemeriksaan kondisi barang yang akan digunakan sebelum maupun sesudah digunakan untuk memastikan keadaan kondisi barang dalam keadaan baik.</li>
              <li>Tidak dibenarkan meninggalkan ruang dalam keadaan kosong dan tidak terkunci.</li>
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
          <div class="collapsible-header"><i class="material-icons">details</i><strong>Peraturan Tambahan</strong></div>
          <div class="collapsible-body">
            <strong>AULA</strong>
            <ol>
              <li>Peserta kegiatan minimal 75 orang. Jika pada waktu pelaksanaan kegiatan peserta yang hadir kurang dari 75 orang, maka kegiatan tersebut harus bersedia dipindahkan di ruangan lain.</li>
              <li>Dilarang masuk ke dalam ruang operator.</li>
              <li>Dilarang melipat/memindahkan kursi tanpa seijin petugas aula.</li>
              <li>Dilarang membawa kunci aula.</li>
              <li>Setelah acara/kegiatan selesai, peminjam/pemakai diwajibkan untuk segera menghubungi petugas aula.</li>
              <li>Dilarang membuang sampah/meninggalkan bekas makanan dan minuman di dalam ruang aula.</li>
            </ol>  
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">details</i><strong>Fasilitas</strong></div>
          <div class="collapsible-body">
            <strong>AULA</strong>
            <ol>
              <li>Kapasitas kursi 200 orang</li>
              <li>Terhubung dengan Gygabytes INTRAnet ITS, dan INTERnet up to 7 GB (Shared with integra authentication)</li>
              <li>Wifi dual band 2.4 GHz dan 5 Ghz</li>
              <li>Proyektor</li>
              <li>Audio System Supported</li>
            </ol>
            <strong>RUANG KELAS</strong>
            <ol>
              <li>Kapasitas kursi 40 orang</li>
              <li>Terhubung dengan Gygabytes INTRAnet ITS, dan INTERnet up to 7 GB (Shared with integra authentication)</li>
              <li>Wifi dual band 2.4 GHz dan 5 Ghz</li>
              <li>Proyektor</li>
            </ol>  
            <strong>LAB. PEMROGRAMAN 1</strong>
            <ol>
              <li>Kapasitas kursi 75 orang</li>
              <li>Terhubung dengan Gygabytes INTRAnet ITS, dan INTERnet up to 7 GB (Shared with integra authentication)</li>
              <li>Wifi dual band 2.4 GHz dan 5 Ghz</li>
              <li>Desktop PC (Processor i5, RAM 8GB, HDD 1TB)</li>
              <li>Proyektor</li>
              <li>Audio System Supported</li>
            </ol>
            <strong>LAB. PEMROGRAMAN 2</strong>
            <ol>
              <li>Kapasitas kursi 54 orang</li>
              <li>Terhubung dengan Gygabytes INTRAnet ITS, dan INTERnet up to 7 GB (Shared with integra authentication)</li>
              <li>Wifi dual band 2.4 GHz dan 5 Ghz</li>
              <li>Desktop PC (Processor i5, RAM 8GB, HDD 1TB)(</li>
              <li>Proyektor</li>
              <li>Audio System Supported</li>
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
      $('.collapsible').collapsible({
        accordion: false
      })
    });

    $(document).ready(function(){
      $('.parallax').parallax();
    });
  </script>
@endsection
