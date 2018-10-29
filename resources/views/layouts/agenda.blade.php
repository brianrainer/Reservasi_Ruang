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
      </div>
    </nav>
  </div>

  <header></header>

  <main>
    @yield('content')
  </main>

  <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>

  <script type="text/javascript" src="{{asset('js/materialize.min.js')}}"></script>

  <script type="text/javascript" src="{{asset('js/moment.min.js')}}"></script>

  <script type="text/javascript" src="{{asset('fullcalendar/fullcalendar.min.js')}}"></script>

  @yield('js')
  
</body>
</html>
