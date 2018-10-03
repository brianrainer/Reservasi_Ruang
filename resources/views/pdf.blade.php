<!DOCTYPE html>
<html>
  <p>Surat ijin ini kami buat dengan maksud untuk meminjam ruang Departemen Informatika untuk acara <strong>{{$title}}</strong> dengan detail sebagai berikut:</p>
  <ol>
  @foreach($booking_details as $booking_detail)
    <li>
      Ruang:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$booking_detail->room}}<br>
      Tanggal:&nbsp;&nbsp;&nbsp;&nbsp;{{$booking_detail->date}}<br>
      Waktu:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$booking_detail->time}}<br><br>
    </li>
  @endforeach
  </ol>
</html>
