<!DOCTYPE html>
<html>
<head>
  <title>ReserveTC - @yield('title')</title>
  <link rel="shortcut icon" href="https://www.its.ac.id/wp-content/themes/ITS/assets/img/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="css/materialize.min.css"> 
  <link rel="stylesheet" type="text/css" href="fullcalendar/fullcalendar.min.css">
  <style type="text/css">
    /* sticky footer */
    body {
      display: flex;
      min-height: 100vh;
      flex-direction: column;
    }

    main {
      flex: 1 0 auto;
    }
  </style>
  @yield('cssScripts')

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  @php
    {{ 
      $menu = ['room'=>'Schedule', 'form'=>'Reservation', 'admin'=>'Admin']; 
    }}
  @endphp

  <div class="navbar-fixed">
    <nav class="blue">
      <div class="nav-wrapper">
        <a href="/" class="brand-logo">
          <img src="https://www.its.ac.id/wp-content/uploads/2017/07/logo.png" style="max-width:100px;">
        </a>
        <a href="#" data-activates="mobile-demo" class="button-collapse">
          <i class="material-icons">menu</i>
        </a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          @foreach ($menu as $m => $mval)
            <li><a href="{{$m}}">{{$mval}}</a></li>
          @endforeach
        </ul>
      </div>
    </nav>
  </div>

  <ul id="mobile-demo" class="side-nav">
    <li>
      <div class="user-view">
        <div class="background">
          <img src="http://materializecss.com/images/office.jpg">
        </div>
        <a href="#">
          <span class="white-text name"> Test1 </span>
        </a>
        <a href="#">
          <span class="white-text email">Test2</span>
        </a>
      </div>
    </li>
    @foreach ($menu as $m => $mval)
      <li><a href="{{$m}}">{{$mval}}</a></li>
    @endforeach
  </ul>

  <header></header>

  <main>
    <div class="container">
      @yield('content')
    </div>
  </main>

  <footer class="page-footer teal">
    <div class="footer-copyright">
      <div class="container">
        <div class="row">
          <div class="col s12 center">
            © 2018. Institut Teknologi Sepuluh Nopember
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- always import the jquery first -->
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

  <script type="text/javascript" src="js/materialize.min.js"></script>

  <script type="text/javascript" src="js/moment.min.js"></script>

  <script type="text/javascript" src="fullcalendar/fullcalendar.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $(".button-collapse").sideNav();
    });
  </script>

  @yield('jsScripts')
  
</body>
</html>