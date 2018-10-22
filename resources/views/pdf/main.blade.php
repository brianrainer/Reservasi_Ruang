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
    <br><br><br>
    <p>Kepada Yth.<br>Bapak {{$head_of_informatic}}<br>Kepala Departemen Informatika ITS<br>di tempat.</p>
    <p>Dengan hormat,</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;Surat ijin ini kami buat dengan maksud untuk meminjam ruang Departemen Informatika untuk acara <strong>{{$booking->event_title}}</strong> dengan detail sebagai berikut:</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;Keterangan: {{$booking->event_description}}</p>
    <ol>
    @foreach($booking_details as $booking_detail)
      <li class="avoid-break">
        Ruang:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$booking_detail->room}}<br>
        Tanggal:&nbsp;&nbsp;&nbsp;&nbsp;{{$booking_detail->date}}<br>
        Waktu:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$booking_detail->time}}<br><br>
      </li>
    @endforeach
    </ol>
    <p class="avoid-break">&nbsp;&nbsp;&nbsp;&nbsp;Bersama surat ini juga saya lampirkan daftar kegiatan yang berlangsung di waktu yang sama. Atas perhatian Bapak/Ibu, saya ucapkan terima kasih.</p>
    <br><br><br>
    <div class="avoid-break">
      <div style="text-align: center; width: 300px; float: left">
        Kepala Departemen Informatika,
        <br><br><br><br><br><br><br>
        {{$head_of_informatic}}
      </div>
      <div style="text-align: center; width: 300px; margin-left: 350px">
        {{$pic_1_title}},
        <br><br><br><br><br><br><br>
        {{$pic_1_name}}
      </div>
    </div>
    @if($pic_2_title && $pic_2_name)
      <br><br>
      <div class="avoid-break" style="text-align: center; page-break-inside: avoid">
        {{$pic_2_title}},
        <br><br><br><br><br><br><br>
        {{$pic_2_name}}
      </div>
    @endif
    @if($attachments)
      <div style="page-break-before: always">
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
