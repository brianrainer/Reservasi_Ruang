<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
      @page {
        margin-top: 0.79in;
        margin-bottom: 0.79in;
        margin-left: 0.79in;
        margin-right: 0.79in;
      }
      .avoid-break {
        page-break-inside: avoid;
      } 
    </style>
  </head>
  <body>
    <div style="text-align: right">Surabaya, {{$date}}</div>
    <br>
    <p>
      Nomor:<br>
      Perihal: Peminjaman Ruang
    </p>
    <p>Kepada Yth.<br>Bapak {{$head_of_informatic}}<br>Kepala Departemen Informatika ITS<br>di tempat.</p>
    <p>Dengan hormat,</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;Surat ijin ini kami buat dengan maksud untuk meminjam ruang Departemen Informatika untuk acara <strong>{{$booking->title}}</strong> yang akan dilaksanakan pada:</p>
    <p>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hari/Tanggal:&nbsp;&nbsp;&nbsp;&nbsp;{{$booking->date}}<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Waktu:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$booking->time}}<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$booking->rooms}}<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deskripsi:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$booking->description}}<br>
    </p>
    <p class="avoid-break">&nbsp;&nbsp;&nbsp;&nbsp;Bersama surat ini juga saya lampirkan daftar kegiatan yang berlangsung di waktu yang sama. Atas perhatian Bapak/Ibu, saya ucapkan terima kasih.</p>
    <br><br><br>
    
    @if($booking->pic_title_2 && $booking->pic_name_2)
      <div class="avoid-break">
        <div style="text-align: center; width: 300px; float: left">
          {{$booking->pic_title_1}},
          <br><br><br><br><br><br><br>
          {{$booking->pic_name_1}}
        </div>
        <div style="text-align: center; width: 300px; margin-left: 350px">
          {{$booking->pic_title_2}},
          <br><br><br><br><br><br><br>
          {{$booking->pic_name_2}}
        </div>
      </div>
      <br><br><br>
      <div class="avoid-break" style="text-align: center; page-break-inside: avoid">
        Kepala Departemen Informatika,
        <br><br><br><br><br><br><br>
        {{$head_of_informatic}}
      </div>
    @else
      <div class="avoid-break">
        <div style="text-align: center; width: 300px; float: left">
          Kepala Departemen Informatika
          <br><br><br><br><br><br><br>
          {{$head_of_informatic}}
        </div>
        <div style="text-align: center; width: 300px; margin-left: 350px">
          {{$booking->pic_title_1}},
          <br><br><br><br><br><br><br>
          {{$booking->pic_name_1}}
        </div>
      </div>
    @endif
    <div style="page-break-before: always">
      <h3><b>Detail Peminjaman</b></h3>
      <ol>
        @foreach($booking_details as $booking_detail)
          <li class="avoid-break">
            Hari/Tanggal:&nbsp;&nbsp;&nbsp;&nbsp;{{$booking_detail->date}}<br>
            Waktu:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$booking_detail->time}}<br>
            Tempat:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$booking_detail->room}}<br><br>
          </li>
        @endforeach
      </ol>
    </div>
    @if($attachments->isNotEmpty())
      <div style="page-break-before: always">
        <h3><b>Kegiatan Lain di Saat yang Sama</b></h3>
        @foreach($attachments as $key => $attachment)
          <p><b>{{$key}}</b></p>
          <ol>
          @foreach($attachment as $detail)
            <li class="avoid-break">
              Kegiatan:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$detail->title}}<br>
              Ruang:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$detail->room}}<br>
              Waktu:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$detail->time}}<br>
              Keterangan:&nbsp;&nbsp;&nbsp;&nbsp;{{$detail->description}}<br><br>
            </li>   
          @endforeach
          </ol>  
        @endforeach
      </div>
    @endif
  </body>
</html>
