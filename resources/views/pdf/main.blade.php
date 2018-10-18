<!DOCTYPE html>
<html>
  <div style="text-align: right">Surabaya, {{$date}}</div>
  <p>Kepada Yth.<br>Bapak {{$head_of_informatic}}<br>Kepala Departemen Informatika ITS<br>di tempat.</p>
  <p>Dengan hormat,</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;Surat ijin ini kami buat dengan maksud untuk meminjam ruang Departemen Informatika untuk acara <strong>{{$booking->event_title}}</strong> dengan detail sebagai berikut:</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;Keterangan: {{$booking->event_description}}</p>
  <ol>
  @foreach($booking_details as $booking_detail)
    <li>
      Ruang:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$booking_detail->room}}<br>
      Tanggal:&nbsp;&nbsp;&nbsp;&nbsp;{{$booking_detail->date}}<br>
      Waktu:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$booking_detail->time}}<br><br>
    </li>
  @endforeach
  </ol>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;Atas perhatian Bapak/Ibu, saya ucapkan terima kasih.</p>
  <div style="text-align:center";max-width:40%>
    Kepala Jurusan Informatika,
    <br><br><br><br><br><br><br>
    {{$head_of_informatic}}
  </div>
  <div style="text-align:center;max-width:40%">
    Test1,
    <br><br><br><br><br><br><br>
    Siapa kek
  </div>
  <div style="text-align:center;max-width:40%">
    Test2
    <br><br><br><br><br><br><br>
    Siapa kek2
  </div>
</html>
