<!DOCTYPE html>
<html>
<head>
  <title>ReserveTC - @yield('title')</title>
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="css/materialize.min.css"> 
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  {{-- @section('sidebar')
  @show --}}

  <nav>
    <div class="nav-wrapper">
      <a href="/" class="brand-logo">Laravel</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse">
        <i class="material-icons">menu</i>
      </a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="room">Jadwal</a></li>
        <li><a href="form">Reservasi</a></li>
        <li><a href="#">Profile</a></li>
      </ul>
      <ul id="mobile-demo" class="side-nav">
        <li><a href="room">Jadwal</a></li>
        <li><a href="form">Reservasi</a></li>
        <li><a href="#">Profile</a></li>
      </ul>
    </div>
  </nav>

  <div class="container">
    @yield('content')
  </div>
  
  <!--Import jQuery before materialize.js-->
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

  <!-- Compiled and minified JavaScript -->
  <script src="js/materialize.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $(".button-collapse").sideNav();
    });
  </script>

  @yield('jscripts')
  
</body>
</html>