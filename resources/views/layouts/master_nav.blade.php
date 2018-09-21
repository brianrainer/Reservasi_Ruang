<li><a href="{{url('')}}">Today</a></li>
<li><a href="{{url('agenda')}}">Agenda</a></li>
<li><a href="{{url('room')}}">Ruangan</a></li>
<li><a href="{{url('reserve')}}">Reservasi</a></li>
<li><a href="{{url('reserve/status')}}">Status</a></li>
<li><a href="{{url('terms')}}">Syarat</a></li>
@if (Auth::check())
  <li><a href="{{url('staff')}}">Staff</a></li>
  <li>
    <form id="logout-form" method="post" action="{{url('logout')}}">
      {{csrf_field()}}
    </form>
    <a onclick="document.getElementById('logout-form').submit()">
      <i class="material-icons prefix">power_settings_new</i>
    </a>
  </li>
@else
  <li><a href="{{url('login')}}">Login</a></li>
@endif
