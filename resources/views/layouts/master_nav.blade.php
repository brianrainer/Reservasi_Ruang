<li><a href="{{url('')}}"><strong>Home</strong></a></li>
<li><a  href="{{url('calendar')}}"><strong>Calendar</strong></a></li>
<li><a href="{{url('room')}}"><strong>Ruangan</strong></a></li>
<li><a href="{{url('reserve')}}"><strong>Reservasi</strong></a></li>
<li><a href="{{url('reserve/status')}}"><strong>Status</strong></a></li>
@if (Auth::check())
  <li><a href="{{url('staff')}}"><strong>Staff</strong></a></li>
  <li>
    <form id="logout-form" method="post" action="{{url('logout')}}">
      {{csrf_field()}}
    </form>
    <a onclick="document.getElementById('logout-form').submit()"><strong>Logout</strong></a>
  </li>
@else
  <li><a href="{{url('login')}}"><strong>Login</strong></a></li>
@endif
