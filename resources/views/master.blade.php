<!DOCTYPE html>
<html>
<head>
  <title>ReserveTC - @yield('title')</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="css/materialize.min.css"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  @php
    {{ 
      $menu = ['room'=>'Schedule', 'form'=>'Reservation', 'profile'=>'Profile']; 
    }}
  @endphp

  <nav class="blue">
    <div class="nav-wrapper">
      <a href="/" class="brand-logo">Laravel</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse">
        <i class="material-icons">menu</i>
      </a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        @foreach ($menu as $m => $mval)
          <li><a href="{{$m}}">{{$mval}}</a></li>
        @endforeach
      </ul>
      <ul id="mobile-demo" class="side-nav">
        @foreach ($menu as $m => $mval)
          <li><a href="{{$m}}">{{$mval}}</a></li>
        @endforeach
      </ul>
    </div>
  </nav>

  <div class="container">
    @yield('content')
  </div>
  
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

  <script type="text/javascript" src="js/materialize.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $(".button-collapse").sideNav();
    });
  </script>

  @yield('jscripts')
  
</body>
</html>