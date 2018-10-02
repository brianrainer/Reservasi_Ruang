<!DOCTYPE html>
<html>
<head>
  <title>@yield('title')</title>

  <link rel="shortcut icon" href="https://www.its.ac.id/wp-content/themes/ITS/assets/img/favicon.ico">

  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="{{asset('css/materialize.min.css')}}"  media="screen,projection"/>

  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <link rel="stylesheet" type="text/css" href="{{asset('fullcalendar/fullcalendar.min.css')}}">

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
  @yield('css')
</head>
<body>
  <div class="navbar-fixed">
    <nav class="blue darken-4">
      <div class="nav-wrapper">
        <a href="/" class="brand-logo valign-wrapper">
          <img src="{{url('/')}}/images/its.png" style="max-width:100px;"></img>
        </a>
        <a href="#" data-target="sidenav_id" class="sidenav-trigger">
          <i class="material-icons">menu</i>
        </a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          @include('layouts.master_nav')
        </ul>
      </div>
    </nav>
  </div>

  <ul id="sidenav_id" class="sidenav sidenav_fixed">
    @include('layouts.master_nav')
  </ul>

  <header></header>

  <main>
    @yield('content')
  </main>

  <footer class="page-footer blue darken-4">
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

  <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>

  <script type="text/javascript" src="{{asset('js/materialize.min.js')}}"></script>

  <script type="text/javascript" src="{{asset('js/moment.min.js')}}"></script>

  <script type="text/javascript" src="{{asset('fullcalendar/fullcalendar.min.js')}}"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $(".sidenav").sidenav();
    });
  </script>

  @yield('js')
  
</body>
</html>
