<li><a style="color:#ffc107" href="{{url('')}}"><strong>Home</strong></a></li>
<li><a style="color:#ffc107" href="{{url('calendar')}}"><strong>Calendar</strong></a></li>
<li><a style="color:#ffc107" href="{{url('room')}}"><strong>Ruangan</strong></a></li>
<li><a style="color:#ffc107" href="{{url('reserve')}}"><strong>Reservasi</strong></a></li>
<li><a style="color:#ffc107" href="{{url('reserve/status')}}"><strong>Status</strong></a></li>
<li><a style="color:#ffc107" href="{{url('terms')}}"><strong>Syarat</strong></a></li>
@if (Auth::check())
  <li><a style="color:#ffc107" href="{{url('staff')}}"><strong>Staff</strong></a></li>
  <li>
    <form id="logout-form" method="post" action="{{url('logout')}}">
      {{csrf_field()}}
    </form>
    <a onclick="document.getElementById('logout-form').submit()">
      <i style="color:#ffc107" class="material-icons prefix">power_settings_new</i>
    </a>
  </li>
@else
  <li><a style="color:#ffc107" href="{{url('login')}}"><strong>Login</strong></a></li>
@endif
